<?php

class ControllerExtensionModuleFclpWl extends Controller
{

    private $extensionType = 'module';
    private $extensionName = 'fclp_wl';

    public function index()
    {
        // Module field
        $moduleStatus = $this->extensionType . '_' . $this->extensionName . '_status';

        $data['fclp_status'] = (bool)$this->config->get($moduleStatus);
        $data['fclp_popup'] = $this->checkPopUp();
        $data['has_languages'] = $this->hasLanguages();
        $data['language'] = $this->load->controller('common/language');

        $this->load->language('extension/' . $this->extensionType . '/' . $this->extensionName);
        $data['text_popup_title'] = $this->language->get('text_popup_title');
        $data['text_popup_description'] = $this->language->get('text_popup_description');

        return $this->load->view('extension/' . $this->extensionType . '/' . $this->extensionName, $data);
    }

    private function checkPopUp()
    {
        if (!isset($this->session->data['fclp_wl']) && !isset($this->request->cookie['fclp_wl'])) {
            $moduleDefaultLanguage = $this->extensionType . '_' . $this->extensionName . '_default_language';

            if ($this->config->get($moduleDefaultLanguage)) {
                // Overwrite the default language cookie
                $this->session->data['language'] = $this->config->get($moduleDefaultLanguage);
                unset($_COOKIE['language']);

                // Overwrite the default language object
                $language = new Language($this->config->get($moduleDefaultLanguage));
                $language->load($this->config->get($moduleDefaultLanguage));
                $this->registry->set('language', $language);
            }

            $this->session->data['fclp_wl'] = true;
            $this->setCookie('fclp_wl', true, time() + (365 * 24 * 60 * 60), '/', $this->request->server['HTTP_HOST']);

            return true;
        }

        return false;
    }

    private function hasLanguages()
    {
        $this->load->model('localisation/language');
        $languages = $this->model_localisation_language->getLanguages();

        $countLanguages = 0;
        foreach ($languages as $language) {
            if ($language['status'] == 1) {
                $countLanguages++;
            }
        }

        return $countLanguages > 1;
    }

    private function setCookie(
        $name,
        $value,
        $expire = 0,
        $path = '/',
        $domain = '',
        $secure = false,
        $httpOnly = false
    ) {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
