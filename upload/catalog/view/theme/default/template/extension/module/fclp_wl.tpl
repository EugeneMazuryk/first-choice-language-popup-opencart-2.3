<?php if ($fclp_status && $fclp_popup && $has_languages) { ?>
    <div class="wl-popup-language-overlay"></div>
    <div class="wl-popup-language">
        <h1><?php echo $text_popup_title; ?></h1>
        <p><strong><?php echo $text_popup_description; ?></strong></p>

        <?php echo $language; ?>

    </div>
    <!-- CSS Styles -->
    <style>
        body {
            overflow: hidden;
        }

        .wl-popup-language-overlay {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 9999;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(8px);
        }

        .wl-popup-language {
            padding: 26px;
            border: 1px solid;
            max-width: 500px;
            box-sizing: border-box;
            border-radius: 5px;
            background: #fff;
            z-index: 10000;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 50%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .wl-popup-language h1 {
            text-align: center;
            margin: 0 auto;
            font-size: 20px;
        }

        .wl-popup-language p {
            margin-top: 11px;
            text-align: center;
        }

        .wl-popup-language #form-language {
            border: #dadada 1px solid;
            border-radius: 4px;
            margin: 6px 0 0;
        }

        .wl-popup-language .language-select {
            text-align: left;
        }

        @media (max-width: 530px) {
            .wl-popup-language {
                margin: 0 15px;
            }
        }

    </style>
    <!-- JS Scripts -->
    <script type="text/javascript"></script>
<?php } ?>
