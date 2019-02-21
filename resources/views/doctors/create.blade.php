
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.add_doctor') }}</h4>
</div>
<div id="result"></div>

<div class="modal-body no-padding">

    <form action="doctors" id="add-medic-form" method="post" class="smart-form">
        <fieldset>

          
                <section class="col-lg-12">
                    <label class="label">{{ trans('lang.name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="name" placeholder="{{ trans('lang.first_name') }}">
                    </label>
                </section>
            

                <section class="col-lg-12">
                    <label class="label">{{ trans('lang.type_procedure') }}</label>
                    <label class="input"> <i class="icon-append fa  fa-mail-forward"></i>
                        <input type="text" name="type_procedure" placeholder="{{ trans('lang.type_procedure') }}">
                    </label>
                </section>
           
        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                {{ trans('lang.add') }} {{ trans('lang.doctor') }}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('lang.cancel') }}
            </button>
        </footer>
    </form>

</div>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery_form/jquery.form.js"></script>

<script>

    

    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#add-medic-form").validate({
        errorClass: errorClass,
        errorElement: errorElement,
        highlight: function (element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },
        // Rules for form validation
        rules: {
            name: {
                required: true
            },
            type_procedure: {
                required: true
            },
           
        },
        // Messages for form validation
        messages: {
            name: {
                required: "{{trans('lang.name')}}"
            },
            type_procedure: {
                required: "{{trans('lang.type_procedure')}}"
            },
           
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            submit_form('#add-medic-form', '#result')
        }
    });
</script>