<script>
    jQuery(document).ready(function($){
        let wrapClass = ".calculator_form"; //Calculator Form Class Select
        let plusBtn = 'button.plus';
        let minussBtn = 'button.minus';
        let selectRadio = '.select-radio';
        const month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];



        function parseFloatFixed(digit){
            return parseFloat(digit).toFixed(2);
        }



        /*
         After  Every Click, Change, Keyup Action
        */
        function getSelectedClass(className, options = {}){
            let catchClass = wrapClass + ` input[data-class="${className}"]`;
            calculated(catchClass, options)
            calculateTotal('main')
            calculateTotal('extra')
            reloadAllCalc()
        }

        /*
        Plus Minus Button  quantity increase decrese
        */
        $(wrapClass).on('click keyup change', `${plusBtn}, ${minussBtn}, ${selectRadio}`, function () {
                let getClickedClass = $(this).attr('class');
                let dataClass = $(this).data('class');
                let takeClass = $(wrapClass + ` input[data-class="${dataClass}"]`);
                let getVal = parseInt(takeClass.val());
                let sections = $(this).data('section_for');
                if(sections){
                    $(`span.error_${sections}`).html('');
                }
                // For Increase Quantity
                if (getClickedClass == 'plus') {
                    let maxValue = takeClass.attr('max');
                    if (maxValue > getVal) {
                        takeClass.val(getVal + 1);
                    } else {
                        alert('You have exceeded the maximum value')
                    }
                }// End

                //For Decrease Quantiy
                if (getClickedClass == 'minus') {
                    let minValue = takeClass.attr('min');
                    if (minValue < getVal) {
                        takeClass.val(getVal - 1);
                    } else {
                        alert('You have exceeded the minimum value')
                    }
                }// End

                getSelectedClass(dataClass) //When decrease increase, function will be call

        }) //End Plus Minus Increase Decrease


        //Main Service Calculate (Property Details)
        function calculateTotal(serviceTypeCls) {
            let sum = serviceTypeCls == 'main' ? parseInt('{{$default_price ?? 0}}') : 0;
            $(`.${serviceTypeCls} .service_amount`).each(function () {
                let doSum = parseFloatFixed($(this).text());
                sum += parseFloat(doSum);
            });
            sum = parseFloatFixed(sum);
            $(`.${serviceTypeCls}_total`).html(sum)
            return sum;
        }


        /** Sum Total Service Amount */
        function sum_service_amount() {
            let sum = parseFloatFixed(parseFloat(calculateTotal('main')) + parseFloat(calculateTotal('extra')));
            $('.sum_service_amount').text(sum);
            return sum;
        }
        /* Sum Sub Total */
        function sum_sub_total_amount(){
            let sum = parseFloatFixed(parseFloat(beforeAfterTotal()) + parseFloat(sum_service_amount()))
            $('.sum_sub_total_amount').html(sum);
            return sum;
        }



        function sum_final_total_amount() {
            // let sum = parseFloatFixed(parseFloat(sum_sub_total_amount()) +parseFloat(sceduleDateTime()) + parseFloat(postCodeAddCalculation()));
            let sum = parseFloatFixed(parseFloat(sum_sub_total_amount()) +parseFloat(sceduleDateTime()) );
                sum =  Math.ceil(sum);
            $('.input_sum_final_total_amount').val(sum);
            $('.sum_final_total_amount').html(sum);
            // showExtraHeader();
            let minumum_price = parseInt("{{$minimumPrice ?? 0}}");
            let alertmsg = '<div class="mt-2 bg-white p-2 pl-3">Minimum charge for this service is ${{$minimumPrice ?? 0}}</div>';
            (sum >= minumum_price) ? $('.minimum_price_notice').html('') : $('.minimum_price_notice').html(alertmsg);

            $('#mobile-proce-v').html('$'+sum)
            return sum;
        }


        /** Before Total After Total */
        function beforeAfterTotal(className = null){
            if(className) {
                let Amount = className == 'before_total' ? calculateTotal('main') : sum_service_amount();
                let catchCls = '.service_amount.' + className;
                let mkclassName = `.calculation_${className}`;
                //console.log($('.calculation_after_total ul li').get())
                let getClass = $(mkclassName+' ul li').get();
                //console.log(getClass)
                for(var i = 0; i < getClass.length; i++){
                    let ele = getClass[i];
                    ele = ele.classList[0];
                    ele = '.'+ele
                    let base_price = parseFloatFixed($(ele + ' ._base_price').val())
                    let equation_type = $(ele + ' ._equation_type').val()
                    let price_value = $(ele + ' ._price_value')
                    let extra_default = $(ele + ' ._extra_default')

                    let doCal = 0;
                    //console.log(price_value)
                    if (equation_type == 'percentage') {
                        doCal = parseFloat((Amount * base_price) / 100).toFixed(2)

                    }
                    if (equation_type == 'fixed') {
                        doCal =  parseInt(base_price)
                    }
                    // console.log($('.service_amount.after_total').get())
                    price_value.val(doCal)
                    $(ele+' '+catchCls).text(doCal)
                }
                /*
                $(mkclassName).each(function () {
                    let base_price = parseFloatFixed($(mkclassName + ' ._base_price').val())
                    let equation_type = $(mkclassName + ' ._equation_type').val()
                    let price_value = $(mkclassName + ' ._price_value')
                    let extra_default = $(mkclassName + ' ._extra_default')
                    let doCal = 0;
                    console.log(equation_type)
                    if (equation_type == 'percentage') {
                        doCal = parseFloat((Amount * base_price) / 100).toFixed(2)

                    }
                    if (equation_type == 'fixed') {
                        doCal =  parseInt(base_price)
                    }
                    // console.log($('.service_amount.after_total').get())
                    price_value.val(doCal)
                    $(catchCls).text(doCal)

                })
                */



            }
            //Total BeforeAfter Amount
            let before_total = 0;
            $('.service_amount.before_total').each(function () {
                let dosum = parseFloatFixed($(this).text())
                before_total += parseFloat(dosum);
            })
            before_total = parseFloat(before_total)

            let after_total = 0;
            $('.service_amount.after_total').each(function () {
                let dosum = parseFloatFixed($(this).text())
                after_total += parseFloat(dosum);
            })
            after_total = parseFloat(after_total)
            return parseFloatFixed(parseFloat(before_total) + parseFloat(after_total))

        }


        /*
        Calculated Function
         */
        function calculated(className, options = {}){
            let title = $(className).data('title');
            let basePrice = $(className).data('base_price');
            let extraDefault = $(className).data('extra_default');
            let mkClass = $(className).attr('name');
            let equationType = $(className).data('equation_type');
            let calculateWith = $(className).data('calculate_with');
            let label = $(className).data('label');
            let accountsType = $(className).data('accounts_type');
            let minimumPrice = $(className).data('minimum_price') ?? 0;
            let qty = $(className).val();
            let defaults = {
                'qty': qty,
            };

            //Array Merge
            let arrMerge = $.extend(defaults, options);
            qty = arrMerge.qty;
            //End
            // console.log(title)
            let orgQty = qty;
            var price = parseFloatFixed((qty * basePrice) + extraDefault);
            price = minimumPrice > price ? minimumPrice : price;
            let ABprice, calculateWithCls, beforeAfterCls; // = calculateWith == 'After Total' ?  sum_service_amount() :  calculateTotal('main')

            if(calculateWith == 'After Total'){
                ABprice = sum_service_amount()
                calculateWithCls = 'after_total';
                beforeAfterCls = '.calculation_'+calculateWithCls;//+calculateWithCls
            }else if(calculateWith == 'Before Total'){
                ABprice =  calculateTotal('main')
                calculateWithCls = 'before_total';
                beforeAfterCls = '.calculation_'+calculateWithCls;
            }else{
                ABprice = sum_service_amount()
                calculateWithCls = '';
                beforeAfterCls = '.'+ accountsType;
            }

            /** Equation Type (Percentage/Fixed) Calculation */
            if (equationType == 'percentage') {
                price = (ABprice * basePrice) / 100;
                //qty = basePrice + '%';
                qty = '&nbsp;';
            } else if (equationType == 'fixed') {
                price = price;
            }
            if(accountsType == 'basic'){
                qty = '&nbsp;';
            }
            let image = $(className).data('image');
            let labels = qty + ' ' + title;
            let serviceCat = `services[${accountsType}]`;
            let sumRightSideDigitCls = 'service_amount '+calculateWithCls;
            let calcSummaryCls = `.order_summary ${beforeAfterCls} ul.list`;
            // console.log(ABprice)
            /* postCode */

            let postCodeEquationType = "{{$postCodeRate->getEquationType->slug ?? null}}"
            let postCoderate = parseFloat("{{$postCodeRate->rate ?? 0}}");


            //let getTotal = rate;
            if(accountsType == 'main' || accountsType == 'extra') {
                if (postCodeEquationType == 'percentage') {
                    postCoderate = parseFloatFixed(price * postCoderate / 100)
                } else {
                    postCoderate = postCoderate
                }

                price = parseFloatFixed(parseFloat(price) + parseFloat(postCoderate));
            }else {
                postCoderate = 0;
            }

            //End
            let priceShowOrNot = accountsType == 'extra' ? null : 'd-none';

            /** Make Html for Right Side Calculator */
             let html = `
                    <li class="${mkClass} mb-3 ${calculateWithCls}">
                        <img src="${image}" style="width: 30px;"/>
                        ${labels}
                      <input type="hidden" name="${serviceCat}[${mkClass}][qty]" value="${orgQty}" />
                      <input type="hidden" class="_price_value" name="${serviceCat}[${mkClass}][amount]" value="${price}" />
                      <input type="hidden" class="_equation_type" name="${serviceCat}[${mkClass}][equation_type]" value="${equationType}" />
                      <input type="hidden" class="_base_price" name="${serviceCat}[${mkClass}][base_price]" value="${basePrice}" />
                      <input type="hidden" class="_extra_default" name="${serviceCat}[${mkClass}][extra_default]" value="${extraDefault}" />
                      <input type="hidden" class="_minimum_price" name="${serviceCat}[${mkClass}][minimum_price]" value="${minimumPrice}" />
                      <input type="hidden" class="_postcode_price" name="${serviceCat}[${mkClass}][postcode_price]" value="${postCoderate}" />
                      <input type="hidden" name="${serviceCat}[${mkClass}][title]" value="${title}" />
                      <input type="hidden" name="${serviceCat}[${mkClass}][slug]" value="${mkClass}" />
                      <div class="float-right ${priceShowOrNot}">
                          $<span class="${sumRightSideDigitCls}">${price}</span>
                      </div>
                  </li>
                `;//End

            let checkClass = $(`.order_summary span`).hasClass(mkClass); //check select service present or not in the calculator
            let bfClass = calcSummaryCls;
            if (checkClass == true) { //if already service present in calcultor, Just replace
                $(bfClass + ' span.' + mkClass + '').html(html)
            } else { //If not then append
                let removeClass = $(bfClass + ' span.' + mkClass).remove()
                $(bfClass).append(`<span class="${mkClass}">${html}</span>`)
            }//End
            qty == 0 ? $(bfClass + ' span.' + mkClass).remove() : null; // if any service has qty 0 then remove

            if(accountsType == 'extra'){
                //beforeAfterTotal('after_total');
            }
            beforeAfterTotal('before_total');
            beforeAfterTotal('after_total');


        }//End Calculate Function



        /**
         * If already set value than work on fly
         */
        setTimeout(function () {
            //On fly

            function reloadSer(accountsType){
                $(`.select-radio[data-accounts_type="${accountsType}"]`).each(function () {
                    let className = $(this).data('class');
                    let dataSelected = $(this).data('selected');
                    let calculateWith = $(this).data('calculate_with');
                    let checked = $(this).attr('checked');
                    //console.log(checked)
                    // if (dataSelected == 'yes') {
                    if (checked == 'checked') {
                        getSelectedClass(className)
                        // calculated(wrapClass + ` input[data-class="${className}"]`);
                        // sum_service_amount();
                    }

                })
            }

            reloadSer('main')
            $('.plus_minus_quantity').each(function () {
                let className = $(this).data('class');
                getSelectedClass(className)

            })
            reloadSer('basic')

        }, 500)

        // Reload All Caculator
        function reloadAllCalc(){
            sum_service_amount();
            sum_sub_total_amount();
            sceduleDateTime()
            postCodeAddCalculation()
            sum_final_total_amount();
            showExtraHeader()
            paymnetNotice()
            // beforeAfterTotal('after_total');

        }



        //Extra text Show if select any Extra
        function showExtraHeader() {
            let ele = $(".extra li").length;
            if (ele === 0) {
                $('.extra .accounts_header').hide()
            } else {
                $('.extra .accounts_header').show()
            }

        }

        showExtraHeader()


        /*====================Modal Section ===================*/

                //On fly

                $('input.calc-open-modal').each(function () {
                    let checked = $(this).prop('checked');
                    let calcId = $(this).data('calc')
                    let className = wrapClass + ` input[data-class="${calcId}"]`;
                    let counterType = $(this).data('counter_type')
                    let service_type = $(this).data('service_type');
                    let html = $('script#' + calcId).html();
                    if (checked == true) {
                        $('.calc-modal .modal-details').html(html)
                        if (counterType == 'popup') {
                            getSelectedClass(calcId)
                            // console.log(calcId)
                        } else {
                            getSelectedClass(calcId, {'qty': 0})
                        }
                    }
                    beforeAfterTotal('before_total');
                    beforeAfterTotal('after_total');

                    reloadAllCalc()
                })

                /**
                 * ModalOpen for Exta
                 * */
                let inputCalcModal = 'input.calc-open-modal';
                $(wrapClass).on('click', `${inputCalcModal} `, function () {
                    let checked = $(this).prop('checked');
                    let calcId = $(this).data('calc')
                    let counterType = $(this).data('counter_type')
                    let html = $('script#' + calcId).html();
                    let service_type = $(this).data('service_type');

                    $('.calc-modal .modal-details').html(html)
                    if (counterType == 'popup') {

                        if (checked == true) {

                            $('#calcModal .modal-dialog').removeClass('modal-lg').addClass('modal-md text-center')
                            $('#calcModal').modal('show');
                            $('.modal-close').attr('data-modal-close', calcId)
                        } else {
                            // $(this).prop("checked", true)
                            $(this).prop("checked", false)
                            $('ul.list span.' + calcId).remove()
                        }
                    } else {
                        let className = wrapClass + ` input[data-class="${calcId}"]`;
                        getSelectedClass(calcId, {'qty': 1})
                        if (checked == true) {

                        } else {
                            $(this).prop("checked", false)
                            $('ul.list span.' + calcId).remove()
                            getSelectedClass(calcId, {'qty': 0})
                        }
                    }
                    beforeAfterTotal('before_total');
                    beforeAfterTotal('after_total');

                    reloadAllCalc()

                })

                //Modal Close
                $(wrapClass).on('click', '.modal-close', function () {
                    let calcId = $(this).attr('data-modal-close');
                    let getDataClass = `input[data-class="${calcId}"]`;
                    let checkVal = $(getDataClass).val();
                    if (checkVal == 0) {
                        $('input[data-calc="' + calcId + '"]').prop("checked", false)
                    } else {
                        $('input[data-calc="' + calcId + '"]').prop("checked", true)
                        // let className = wrapClass + ` input[data-class="${calcId}"]`;
                        getSelectedClass(calcId, {'qty': checkVal})
                    }
                    // alert(checkVal)
                    // alert(calcId)
                    beforeAfterTotal('after_total')
                    reloadAllCalc()
                })


                //Modal Cancel(Service)
                $(wrapClass).on('click', '.modal-cancel', function () {
                    let calcId = $(this).attr('data-modal-close');
                    let getDataClass = `input[data-class="${calcId}"]`;
                    let checkVal = $(getDataClass).val();
                    // if (checkVal == 0) {
                    $('input[data-calc="' + calcId + '"]').prop("checked", false)
                    $('ul.list span.' + calcId).remove()
                    // }
                    //alert(checkVal)
                    $(this).data('modal-close', null)
                    beforeAfterTotal('before_total');
                    beforeAfterTotal('after_total');
                    reloadAllCalc()
                })

                /* ==============
               // Tooltip Modal
               ================ */
                $(wrapClass).on('click', 'i.toltip', function () {
                    let toltip = $(this).data('toltip');
                    let html = $('script#tooltips_' + toltip).html();
                    $('.toltip_content .modal-dialog').removeClass('modal-md text-center').addClass(' modal-lg')
                    $('.toltip_content .modal-details').html(html)
                    $('.toltip_content').modal('show');
                })
        /** End  */











        /* ==================
        Schedule ============
         ===================*/

            function sceduleDateTime(){
                let selectedDate = $('.schedule-date').val();

                let sceduleTimeCls = $('select.schedule_time').find(':selected')
                let sceduleTime = sceduleTimeCls.val() ?? ''
                let orgRate = $('.schedule-date').attr('data-rate')?? 0 //sceduleTimeCls.data('rate') ?? 0
                let equationType = $('.schedule-date').attr('data-equation_type') ?? '' //sceduleTimeCls.data('equation_type') ?? ''
                let getid = sceduleTimeCls.data('id') ?? null;
                let getTime = sceduleTimeCls.text();

                let datep = new Date(selectedDate);
                let getDay = days[datep.getDay()]; //days variable assign to top
                let showDateDay = `${datep.getDate()} ${month[datep.getMonth()]} ${datep.getFullYear()}`
                //console.log(orgRate)
                let serviceCat = `services[other]`;
                sceduleTime == 'Select a time' ? '' : $('.schedule_time_errormsg').hide() + $('.schedule_time').removeClass('border-danger')

                let rate = orgRate ?? 0;
                if (equationType == 'percentage') {
                    rate = parseFloatFixed(parseFloat(sum_sub_total_amount() * rate) / 100);
                }


                let title = `{!!json_encode(['Date'=> '${selectedDate}',
                                'Time' => '${getTime}',
                                'Day' => '${getDay}',
                                'TimeId' => '${getid}',
                                ])!!}`;
                let html = `
                        <span class="show_schedule_date_time_day">${getTime}<br>${getDay}, ${showDateDay}</span>
                        <input type="hidden" name="${serviceCat}[schedule][title]" value='${title}'/>
                        <input type="hidden" name="${serviceCat}[schedule][base_price]" value="${orgRate}" />
                        <input type="hidden" name="${serviceCat}[schedule][amount]" value="${rate}" />
                        <input type="hidden" name="${serviceCat}[schedule][slug]" value="schedule_date_time" />
                        <input type="hidden" name="${serviceCat}[schedule][equation_type]" value="${equationType}" />
                        <div class="float-right d-none">
                            $<span class="schedule_date_time">${rate}</span>
                        </div>
                    `;
                if(selectedDate) {
                    $('.calculation_order_date_time_postcode li.schedule_date_time').html(`<span class="schedule_date_time_area">${html}</span>`)
                }
                return rate;
            }

            $('.schedule_date_time').on('change', '.schedule-date, select.schedule_time', function () {
                let selectClass = $(this).hasClass('schedule-date')
                //console.log(selectClass)

                if(selectClass == true) {
                    // $('select.schedule_time').val(null)
                    $.ajax({
                        method: "GET",
                        url: "{{route('frontend_booking_schedule_time')}}",
                        data: {
                            'get_date':  $('.schedule-date').val(),
                            'zone_id': "{{$zone_id ?? null}}",
                            'sub_service_id': "{{$set_sub_service_id ?? null}}",
                        },
                        _token: "{{csrf_token()}}",
                        success: function (r) {
                            $('.schedule-date').attr({
                                'data-rate': r.rate ?? 0,
                                'data-equation_type': r.equation_type ?? false,
                            })
                            sceduleDateTime()
                            reloadAllCalc()
                        }
                    })
                };

                //console.log(2)
                sceduleDateTime()
                reloadAllCalc()
            })


             sceduleDateTime()
        // End



            /** Calculation Order Date Time */
            function postCodeAddCalculation(){
                let total = parseFloatFixed(sum_sub_total_amount());
                let postCodeEquationType = "{{$postCodeRate->getEquationType->slug ?? null}}"
                let rate = parseFloat("{{$postCodeRate->rate ?? 0}}");
                let getTotal = 0 //rate;
                let text = rate;
                if(postCodeEquationType == 'percentage'){
                    getTotal = parseFloat(total*getTotal)/100;
                    text = rate +'%'
                }
                getTotal = parseFloatFixed(getTotal)
                let serviceCat = `services[other]`;
                {{-- ${text} for Postcode {{$postCode ?? null}}--}}
                if(rate > 0) {
                    let html = `
                        <div>
                        Post Code: {{$postCode ?? null}}
                            <input type="hidden" name="${serviceCat}[postcode][title]" value="Postcode {{$postCode ?? null}}" />
                            <input type="hidden" name="${serviceCat}[postcode][base_price]" value="${rate}" />
                            <input type="hidden" name="${serviceCat}[postcode][amount]" value="${getTotal}" />
                            <input type="hidden" name="${serviceCat}[postcode][slug]" value="postcode" />
                            <input type="hidden" name="${serviceCat}[postcode][equation_type]" value="${postCodeEquationType}" />
                            <div class="float-right d-none">
                            $<span class="postcode loadCalc">${getTotal}</span>
                        </div>
                    `;
                    $('.calculation_order_date_time_postcode li.postcode').html(`<span class="postcode_area">${html}</span>`)
                }
                return getTotal;
            }


        function paymnetNotice(){
            let sumTotal =  sum_final_total_amount()
            let minumum_price = parseInt("{{$minimumPrice ?? 0}}");
                minimumBookingAmountAsPercentage = "{{ $Query::frontendSettings('minimum_booking_amount_as_percentage') ?? 20}}"
                payAmount =  (sumTotal >= minumum_price) ? sumTotal : minumum_price;
                payAmount = parseFloatFixed(((payAmount*minimumBookingAmountAsPercentage)/100));
                payAmount = Math.ceil(payAmount)
                sign = '$';
                selectedDate = $('.schedule-date').val();
                datep = new Date(selectedDate);
                getDay = days[datep.getDay()]; //days variable assign to top
                showDateDay = `${datep.getDate()-1} ${month[datep.getMonth()]} ${datep.getFullYear()}`
                paymentDate = selectedDate ? `Balance should be paid by <b>${showDateDay}</b>.` : '';
                // html = `You need to deposit <b>${sign}${payAmount}</b> now to confirm the booking. ${paymentDate}`;
                html = `You need to deposit <b>${sign}${payAmount}</b> now to confirm the booking.`;

            $('.payment_notice').html(html)
        }




        /*====================
       //Submit Form
       ================ */
        $('.submit_form, .add_another_form_submit').click(function (e) {
            e.preventDefault()
            let addAnotherForm = $(this).hasClass('add_another_form_submit');
            let subMitForm = $(this).hasClass('submit_form');
            let errors = true;
            $('.basic_service_side input:radio').each(function (){
                let name = $(this).attr('name')
                let section = $(this).data('section_for')
                if($(".basic_service_side input:radio[name="+name+"]:checked").length == 0){
                    errors = false;
                    $(`.error_${section}`).html('Please answer this')
                }else {
                    $(`.error_${section}`).html('')
                }
            })

            if(errors == true) {
                if (addAnotherForm == true) {
                    let s = $('select[name="sub_term_id"]').val();
                    if (s == null) {
                        //alert('Please select a service')
                        $('.sub_term_errormsg').show()
                        $('#level_no_get').addClass('border-danger')
                    } else {
                        let minimumPrice = parseInt(`{{$minimumPrice ?? 0}}`)
                        let total = parseInt($('.sum_final_total_amount').text());
                        let checkScheduleTime = $('select.schedule_time').find(':selected').val();
                        if (checkScheduleTime == null || checkScheduleTime == 'Select a time') {
                            //Time
                            $('.schedule_time_errormsg').show()
                            $('.schedule_time').addClass('border-danger')
                        } else {
                            // let alertIfMinimumNotFill =
                            if (total >= minimumPrice) {
                                $('.order_form').submit()
                            } else {
                                // alert(`You did not meet the required order amount. Your order's minimum amount must be ${minimumPrice}$`)
                                $('.input_sum_final_total_amount').val(minimumPrice);
                                $('.sum_final_total_amount').html(minimumPrice);
                                $('.order_form').submit();
                            }
                        }

                    }
                } else if (subMitForm == true) {
                    let minimumPrice = parseInt(`{{$minimumPrice ?? 0}}`)
                    let total = parseInt($('.sum_final_total_amount').text());
                    let checkScheduleTime = $('select.schedule_time').find(':selected').val();
                    if (checkScheduleTime == null || checkScheduleTime == 'Select a time') {
                        $('.schedule_time_errormsg').show()
                        $('.schedule_time').addClass('border-danger')
                    } else {
                        if (total >= minimumPrice) {
                            $('.order_form').submit()

                        } else {
                            // alert(`You did not meet the required order amount. Your order's minimum amount must be ${minimumPrice}$`)
                            $('.input_sum_final_total_amount').val(minimumPrice);
                            $('.sum_final_total_amount').html(minimumPrice);
                            $('.order_form').submit();
                        }
                    }
                    // let alertIfMinimumNotFill =

                }
            }
        })//End Submit Form
    })




















</script>



<link rel="stylesheet" href="{{$publicDir}}/frontend/css/calculator-form.css?{{rand(0,999)}}">
<style>
    .calculator_form.modal {
        text-align: center;
        padding: 0 !important;
    }

    .calculator_form.modal:before {
        content: '';
        display: inline-block;
        /*height: 100%;*/
        vertical-align: middle;
        margin-right: -4px; /* Adjusts for spacing */
    }

    .calculator_form .modal-dialog.modal-dialog-centered {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }

    .calculator-body {
        position: -webkit-sticky;
        position: sticky;
        xtop: 25%;
        height: 100%;
        overflow: auto;
    }


    .modal {
        text-align: center;
    }

    /*.d-none {*/
    /*    display: block !important;*/
    /*}*/
</style>
