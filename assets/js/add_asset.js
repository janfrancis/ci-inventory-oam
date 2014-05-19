$(document).ready(function() {

        jQuery.validator.addMethod("phone", function (value, element) {
          return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
        }, "Enter a valid phone number.");
        

        jQuery.validator.addMethod("nameValidation", function (value, element) {
          return this.optional(element) || /^[a-z\-.,\s]+$/i.test(value);
        }, "Name must not contain special characters except comma, dash and period.");

        jQuery.validator.setDefaults({
          debug: true,
          //success: "valid"
        });
        $('#add_asset').validate({
          errorElement: 'span',
          errorClass: 'help-inline',
          focusInvalid: false,
          rules: {
            asset_code: {
              required: true,
              remote: {
                url: "<?php echo base_url();?>asset/asset_code_exist",
                type: "post",
                data: {
                  asset_code: function(){ return $("#asset_code").val(); }
                }
              }
            },
            ip_address: {
              required: true,
              ipv4 : true,  
            },
            serial: {
              required: true,
            },
            brand: {
              required: true,
            },
            model: {
              required: true,
            },
            type: {
              required: true,
            },
            location: {
              required: true,
            },
            status: {
              required: true,
            },
            note: {
              //required: true,
            },
            
          },
       
          messages: {
           asset_code:{
              remote : "This asset code is taken.",
           },   
          },
      
          invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-error', $('.login-form')).show();
          },
      
          highlight: function (e) {
            $(e).closest('.control-group').removeClass('success').addClass('error');
          },
      
          success: function (e) {
            $(e).closest('.control-group').removeClass('error').addClass('success');
            $(e).remove();

          },
      
          errorPlacement: function (error, element) {
         

            if(element.is(':checkbox') || element.is(':radio')) {
              var controls = element.closest('.controls');
              if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
              else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
              error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chzn-select')) {
              error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
            }
            else error.insertAfter(element);
          },
          showErrors: function(errorMap, errorList) {
            $("#summary").html("<div class=\"alert alert-error\">Your form contains "
              + this.numberOfInvalids()
              + " errors, see details below.</div>");
              this.defaultShowErrors();
          },
          submitHandler: function (form) {
            //alert("Add Successfully");
            form.submit();

          },
          invalidHandler: function (form) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            
          },

        });
      
        
      });