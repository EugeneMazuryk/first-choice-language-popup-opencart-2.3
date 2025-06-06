<?php

class ControllerExtensionModuleFclpWl extends Controller {

	private $extensionType = 'module';
	private $extensionName = 'fclp_wl';
	private $error = array();

	public function index() {

		$this->load->language('extension/' . $this->extensionType . '/' . $this->extensionName);

		$this->document->setTitle($this->language->get('heading_title_text'));

		$this->load->model('setting/setting');

		// Post request
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting($this->extensionType . '_' . $this->extensionName, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/' . $this->extensionType . '/' . $this->extensionName, 'token=' . $this->session->data['token'] . '&type=' . $this->extensionType, true));
		}

		$data['heading_title'] = $this->language->get('heading_title_text');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_default_language'] = $this->language->get('entry_default_language');
		$data['help_default_language'] = $this->language->get('help_default_language');
		$data['text_select_default_language'] = $this->language->get('text_select_default_language');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_clear_session'] = $this->language->get('entry_clear_session');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'token=' . $this->session->data['token'] . '&type=' . $this->extensionType, true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title_text'),
			'href' => $this->url->link('extension/' . $this->extensionType . '/' . $this->extensionName, 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/' . $this->extensionType . '/' . $this->extensionName, 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'token=' . $this->session->data['token'] . '&type=' . $this->extensionType, true);

		// Module field
		if (isset($this->request->post[$this->extensionType . '_' . $this->extensionName . '_status'])) {
			$data[$this->extensionType . '_' . $this->extensionName . '_status'] = $this->request->post[$this->extensionType . '_' . $this->extensionName . '_status'];
		} else {
			$data[$this->extensionType . '_' . $this->extensionName . '_status'] = $this->config->get($this->extensionType . '_' . $this->extensionName . '_status');
		}

		if (isset($this->request->post[$this->extensionType . '_' . $this->extensionName . '_default_language'])) {
			$data[$this->extensionType . '_' . $this->extensionName . '_default_language'] = $this->request->post[$this->extensionType . '_' . $this->extensionName . '_default_language'];
		} else {
			$data[$this->extensionType . '_' . $this->extensionName . '_default_language'] = $this->config->get($this->extensionType . '_' . $this->extensionName . '_default_language');
		}

		$this->load->model('localisation/language');

		$data[$this->extensionType . '_' . $this->extensionName . '_languages'] = $this->model_localisation_language->getLanguages();
		$data[$this->extensionName . '_clear_session'] = $this->url->link('extension/' . $this->extensionType . '/' . $this->extensionName . '/clear', 'token=' . $this->session->data['token'], true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/' . $this->extensionType . '/' . $this->extensionName, $data));
	}

	protected function validate() {

		if (!$this->user->hasPermission('modify', 'extension/' . $this->extensionType . '/' . $this->extensionName)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function clear() {
		$this->clearModuleData();

		$this->load->language('extension/' . $this->extensionType . '/' . $this->extensionName);
		$this->session->data['success'] = $this->language->get('text_clear_session');

		$this->response->redirect($this->url->link('extension/' . $this->extensionType . '/' . $this->extensionName, 'token=' . $this->session->data['token'] . '&type=' . $this->extensionType, true));
	}

	public function install() {
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'extension/module/fclp_wl');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'extension/module/fclp_wl');
	}

	public function uninstall() {
		$this->load->model('user/user_group');
		$this->model_user_user_group->removePermission($this->user->getId(), 'access', 'extension/module/fclp_wl');
		$this->model_user_user_group->removePermission($this->user->getId(), 'modify', 'extension/module/fclp_wl');

		$this->clearModuleData();
	}

	private function clearModuleData() {
		unset($this->session->data['fclp_wl']);
		setcookie('fclp_wl', '', time() - 3600, '/', $this->request->server['HTTP_HOST']);
	}
}