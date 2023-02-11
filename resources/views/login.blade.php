<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" id="elementor-frontend-css" href="{{ url('assets/css/login.css') }}" type="text/css" media="all">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

    <script src="{{ url('assets/js/login.js') }}"></script>
    <script>
        var user = "{{Auth::user()}}";
    </script>
</head>

<body class="page-template page-template-elementor_canvas page page-id-2 elementor-default elementor-template-canvas elementor-kit-5 elementor-page elementor-page-2">
    <div data-elementor-type="wp-page" data-elementor-id="2" class="elementor elementor-2" data-elementor-settings="[]">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                <section class="elementor-section elementor-top-section elementor-element elementor-element-11ddf740 elementor-section-height-min-height elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-items-middle" data-id="11ddf740" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3524a90d" data-id="3524a90d" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;none&quot;}">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <section class="elementor-section elementor-inner-section elementor-element elementor-element-1065cf86 elementor-section-height-min-height elementor-section-content-middle elementor-section-boxed elementor-section-height-default" data-id="1065cf86" data-element_type="section">
                                            <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-16aa1ff8" data-id="16aa1ff8" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-548fde5 elementor-widget elementor-widget-image" data-id="548fde5" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-image">
                                                                            <img src="{{ url('assets/img/logo.png') }}" class="attachment-large size-large" alt="" loading="lazy" srcset="{{ url('assets/img/logo.png') }} 350w, {{ url('assets/img/logo.png') }} 300w" sizes="(max-width: 350px) 100vw, 350px" width="350" height="75">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-f89da2a elementor-button-align-stretch elementor-widget elementor-widget-form" data-id="f89da2a" data-element_type="widget" data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}" data-widget_type="form.default">
                                                                    <div class="elementor-widget-container">
                                                                        <form class="elementor-form" id="loginForm" name="New Form">
                                                                            <input type="hidden" name="post_id" value="2">
                                                                            <input type="hidden" name="form_id" value="f89da2a">
                                                                            <input type="hidden" name="queried_id" value="2">
                                                                            {{csrf_field()}}
                                                                            <div class="elementor-form-fields-wrapper elementor-labels-">
                                                                                <div class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                                                                                    <label for="form-field-email" class="elementor-field-label elementor-screen-only">Email</label><input size="1" type="email" name="email" id="form-field-email" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Email" required aria-required="true">
                                                                                </div>
                                                                                <div class="elementor-field-type-password elementor-field-group elementor-column elementor-field-group-name elementor-col-100">
                                                                                    <label for="form-field-name" class="elementor-field-label elementor-screen-only">Password</label><input size="1" type="password" name="password" id="form-field-name" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="Password" value="admin@Rbs7$R5">
                                                                                </div>
                                                                                <!-- <div class="elementor-field-type-checkbox elementor-field-group elementor-column elementor-field-group-field_360e747 elementor-col-100">
                                                                                    <label for="form-field-field_360e747" class="elementor-field-label elementor-screen-only">Remember Me</label>
                                                                                    <div class="elementor-field-subgroup  "><span class="elementor-field-option"><input type="checkbox" value="Remember Me" id="form-field-field_360e747-0" name="form_fields[field_360e747]"> <label for="form-field-field_360e747-0">Remember Me</label></span></div>
                                                                                </div> -->
                                                                                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                                                                    <button id="btnLogIn" type="submit" class="elementor-button elementor-size-sm">
                                                                                        <span>
                                                                                            <span class=" elementor-button-icon"></span>
                                                                                            <span class="elementor-button-text">LOG IN</span>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-9e84b95" data-id="9e84b95" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                                                        <div class="elementor-column-wrap elementor-element-populated">
                                                            <div class="elementor-background-overlay"></div>
                                                            <div class="elementor-widget-wrap">
                                                                <div class="elementor-element elementor-element-72f600e elementor-widget elementor-widget-heading" data-id="72f600e" data-element_type="widget" data-widget_type="heading.default">
                                                                    <div class="elementor-widget-container">
                                                                        <h2 class="elementor-heading-title elementor-size-default">Welcome.</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-248eec4 elementor-widget elementor-widget-text-editor" data-id="248eec4" data-element_type="widget" data-widget_type="text-editor.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-text-editor elementor-clearfix">
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-35abf81 elementor-widget elementor-widget-spacer" data-id="35abf81" data-element_type="widget" data-widget_type="spacer.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-spacer">
                                                                            <div class="elementor-spacer-inner"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>