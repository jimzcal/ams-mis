<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use backend\models\Accounts;
use backend\models\SubLedgerAccounts;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\JournalEntry */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Update JEV - Loan Payment';

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<div class="journal-entry-form">
    <div class="main-panel">
        <div style="font-size: 32px; color: #999999">
            <i class="fa fa-credit-card"></i> Loan Remittance
        </div>
        <br>
        <?php $form = ActiveForm::begin(); ?>

        <div style="width: 100%; border-bottom: solid 1px #cccccc">
            <div class="topnav" style="width: 34.5%;">
                <span class = 'topnav-menu-first' onclick="particulars()">Particulars</span>
                <span class = 'topnav-menu' onclick="attachments()">Attachments</span>
                <span class = 'topnav-menu-last' onclick="accounting_entry()">Accounting Entry</span>
            </div>
        </div>
        <br>

        <table style="width: 100%; padding: 5px;" id="particulars">
            <tr>
                <td colspan="3" style="padding-right: 3px;">
                    <?= $form->field($model2, 'jev_no')->textInput(['maxlength' => true, 'value' => $model->jev_no]) ?>
                </td>
                <td style="width: 30%">
                    <?= $form->field($model2, 'date_transaction')->widget(DatePicker::classname(), [
                        'options' => [
                            //'class' => 'new-textfield',
                            'placeholder' => 'Date',
                            'autofocus' => 'autofocus',
                            'value' => $model->date_transaction,
                        ],

                        'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-m-d',
                        
                            ]
                        ]); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <?= $form->field($model2, 'particulars')->textarea(['rows' => 10, 'value' => $model->particulars]) ?>
                </td>
            </tr>
        </table>

        <table class="table table-bordered table-striped table-condensed" id="attachments" width="100%">
            <tr>
                <td colspan="3">
                    <button style="float: right; font-size: 10px; " class="btn btn-default btn-right" type="button" onclick="myFunction1()" >
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </td>
            </tr>
            <?php 
                $attachments = explode('^', $model->attachments);
                $attach_no = explode('^', $model->attach_no);
                $attach_date = explode('^', $model->attach_date);
            ?>
            <?php for($i = 0; $i < sizeof($attachments); $i++) : ?>
            <tr id="attachments_tr">
                <td>
                    <?= $form->field($model2, 'attachments[]', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'value' => $attachments[$i]])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($model2, 'attach_no[]', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'value' => $attach_no[$i]])->label(false) ?>
                </td>
                <td>
                    <!-- <?php// $form->field($model2, 'attach_date[]', ['options' => ['tag' => false]])->textInput(['value' => $attach_date[$i], 'class' => 'textfield'])->label(false) ?> -->

                    <?= $form->field($model, 'attach_date[]')->widget(DatePicker::classname(), [
                        'options' => [
                            //'class' => 'new-textfield',
                            'placeholder' => 'Date',
                            'autofocus' => 'autofocus',
                            'value' => $attach_date[$i],
                        ],

                        'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-m-d',
                            ]
                    ])->label(false); ?>
                </td>
            </tr>
            <?php endfor ?>
        </table>

        <table id="myTable" class="table table-striped table-condensed table-bordered">
            <?php foreach($journal_entry as $key => $value): ?>
            <tr>
                <td style="width: 50%; padding-right: 5px;">
                    <?= $form->field($model2, 'ids[]')->hiddenInput(['value' => $value->id])->label(false) ?>

                    <?= $form->field($model2, 'account_code[]', ['options' => ['tag' => false]])
                                ->dropDownList(ArrayHelper::map(Accounts::find()
                                    ->where(['status' => 'Active'])
                                    ->orderBy(['account_name'=> SORT_ASC])
                                    ->all(),'account_code', 
                                function($model)
                                {
                                    return $model->account_code.' - '.$model->account_name;
                                }
                            ),
                            [ 
                                'class' => 'textfield',
                                'multiple' => false,
                                'value' => $value->account_code,
                                'id' => 'id_1'
                    ])->label(false); ?>
                </td>
                <td style="width: 25%;">
                <?php if($value->account_code == '11110') : ?>
                    <?= $form->field($model2, 'debit[]')->textInput(['maxlength' => true, 'class' => 'textfield id_debit', 'style' => 'text-align: right', 'value' => $value->debit, 'data-toggle' => 'modal', 'data-target' => '#subModal'])->label(false) ?>
                <?php else : ?>
                    <?= $form->field($model2, 'debit[]')->textInput(['maxlength' => true, 'class' => 'textfield id_debit', 'style' => 'text-align: right', 'value' => $value->debit, 'readOnly' => true])->label(false) ?>
                <?php endif ?>
                </td>
                <td style="width: 25%;">
                <?php if($value->account_code == '11210') : ?>
                    <?= $form->field($model2, 'credit[]')->textInput(['maxlength' => true, 'class' => 'textfield id_credit', 'style' => 'text-align: right', 'value' => $value->credit, 'id' => 'receivable_id', 'data-toggle' => 'modal', 'data-target' => '#newModal'])->label(false) ?>
                <?php else : ?>
                     <?= $form->field($model2, 'credit[]')->textInput(['maxlength' => true, 'class' => 'textfield id_credit', 'style' => 'text-align: right', 'value' => $value->credit, 'id' => 'receivable_id'])->label(false) ?>
                <?php endif ?>
                </td>
            </tr>
            <?php endforeach ?>
            <tr style="border-bottom: solid 1px; border-top: solid 1px;">
                <td style="padding-left: 10px; width: 50%;">T O T A L :</td>
                <td style="width: 25%; text-align: right; font-style: italic; vertical-align: middle;">
                    <?= $form->field($model2, 'total_debit')->textInput(['maxlength' => true, 'class' => 'hidden-field', 'style' => 'text-align: right', 'id' => 'totalDebit'])->label(false) ?>
                </td>
                <td style="width: 25%; text-align: right; font-style: italic; vertical-align: middle;">
                    <?= $form->field($model2, 'total_credit')->textInput(['maxlength' => true, 'class' => 'hidden-field', 'style' => 'text-align: right', 'id' => 'totalCredit'])->label(false) ?>
                </td>
            </tr>
            <tr>
            <td colspan="3">
                <?php if(Yii::$app->user->can('reviewApproveJournalEntry')) : ?>
                    <?= $form->field($model2, 'status')->dropDownList(['For Review'=>'For Review', 'Approved'=>'Approved', 'Cancel' => 'Cancel'],
                        [
                            'value' => $model->status,
                        ]
                    )->label('Action') ?>
                    <?php else : ?>
                        <?= $form->field($model2, 'status')->hiddenInput(['value' => 'For Review'])->label(false) ?>
                <?php endif ?>
                <br>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
            </td>
        </table>
    </div>
</div>

<div id="subModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 70%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="trigger_sub_total">&times;</button>
             <h4 class="modal-title">&nbsp&nbsp S U B S I D I A R Y &nbsp L E D G E R</h4>
          </div>
          <div class="modal-body">
                <div class="news-content-modal">
                   <table style="width: 98%">
                        <!-- <tr style="background-color: #d4b81f;">
                            <td colspan="3" style="color: #fff; padding-left: 5px; width: 950px;">
                                
                            </td>
                        </tr> -->
                        <tr>
                            <td colspan="3" style="height: 20px;"></td>
                        </tr>
                        
                        <tr id="myTr">
                            <td style="width: 50%; padding-right: 5px;">
                                  <?= $form->field($model2, 'sub_account', ['options' => ['tag' => false]])
                                            ->dropDownList(ArrayHelper::map(SubLedgerAccounts::find()
                                                ->where(['mother_account' => '11110'])
                                                ->orderBy(['account_title'=> SORT_ASC])
                                                ->all(),'account_code', 
                                            function($model)
                                            {
                                                return $model->account_code.' '.$model->getSltype($model->account_code).' - '.$model->account_title;
                                            }
                                        ),
                                            [ 
                                                'value' => $sl_treasurer->account_code,
                                                'class' => 'new-textfield',
                                                'id' => 'id_4',
                                    ])->label(false); ?>
                            </td>
                            <td style="width: 25%">
                               <?= $form->field($model2, 'sub_debit')->textInput(['maxlength' => true, 'class' => 'new-textfield', 'id' => 'sub_debit_id', 'style' => 'text-align: right', 'value' => $sl_treasurer->debit])->label(false) ?>
                            </td>
                            <td style="width: 25%">
                                <?= $form->field($model2, 'sub_credit')->textInput(['maxlength' => true, 'class' => 'new-textfield', 'style' => 'text-align: right', 'value' => $sl_treasurer->credit, 'readOnly' => true])->label(false) ?>
                            </td>
                        </tr>
                    </table>
                </div>
          </div>
        </div>
    </div>
</div>

<div id="newModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 95%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="trigger_total">&times;</button>
             <h4 class="modal-title">Monthly Loan Re-payment</h4>
          </div>
          <div class="modal-body">
                <div class="news-content-modal">
                   
                    <table class="table table-bordered margin-less">
                        <tr>
                            <td colspan="15" style="background-color: #d4b81f">
                                <span class="fa fa-refresh trigger_compute" style="float: right; font-size: 18px;" id = 'trigger_compute'></span>
                            </td>
                        </tr>
                        <tr>
                            <th rowspan="2" style="width: 3%;">No.</th>
                            <th rowspan="2">Fullname</th>
                            <th colspan="3">Monthly Amortization</th>
                            <th colspan="4">Actual Remittance</th>
                            <th rowspan="2">Deficit</th>
                            <th rowspan="2">Prev. Surcharge</th>
                            <th rowspan="2">Surcharge</th>
                        </tr>
                        <tr>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Total</th>
                            <th style="width: 8%;">Remittance</th>
                            <th style="width: 8%;">Principal</th>
                            <th style="width: 8%;">Interest</th>
                            <th style="width: 8%;">Surcharge</th>
                        </tr>
                        <?php
                            $total_principal = 0.00;
                            $total_interest = 0.00;
                            $total_surcharge = 0.00;
                            $total_remittance = 0.00;
                            $total_current_surcharge = 0.00;
                         ?>
                        <?php foreach($dataProvider as $key => $value) : ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td>
                                <?= $value->fullname ?>
                                <?= $form->field($model2, 'fullname[]')->hiddenInput(['value' => $value->fullname])->label(false) ?>
                                
                                <?= $form->field($model2, 'sub_loan_account[]')->hiddenInput(['value' => $value->account_code])->label(false) ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;">
                               
                            </td>
                            <td style="text-align: right; font-weight: bold;">
                                
                            </td>
                            <td style="text-align: right; font-weight: bold;">
                                
                            </td>
                            <td>
                                <?= $form->field($model2, 'remittance[]')->textInput(['value' => $value->actual_remittance, 'class' => 'new-textfield trigger-remittances remit', 'id' => 'remittance_'.$key, 'style' => 'text-align: right'])->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model2, 'sub_loan_principal[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield principal_amount loan', 'id' => 'journalentry-sub_loan_principal_'.$key, 'style' => 'text-align: right', 'value' => $value->actual_principal, 'readOnly' => true])->label(false) 
                                ?>
                            </td>
                            <td>
                                <?= $form->field($model2, 'interest_2[]', ['options' => ['tag' => false]])->hiddenInput(['id' => 'interest_2_'.$key, 'value' => $value->actual_interest])->label(false) 
                                ?>

                                <?= $form->field($model2, 'sub_loan_interest[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield trigger-interest interest_loan', 'id' => 'journalentry-sub_loan_interest_'.$key, 'style' => 'text-align: right', 'value' => $value->actual_interest, 'readOnly' => true])->label(false) 
                                ?>
                            </td>
                            <td>
                                <?= $form->field($model2, 'surcharge_payment[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield surcharge_payment', 'id' => 'journalentry-surcharge_payment_'.$key, 'style' => 'text-align: right', 'value' => $value->actual_surcharge])->label(false) 
                                ?>
                            </td>
                            <td style="width: 8%; text-align: right;">
                                <?= $form->field($model2, 'deficit[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield', 'id' => 'journalentry-sub_loan_deficit_'.$key, 'style' => 'text-align: right', 'value' => $value->deficit])->label(false) 
                                ?>
                            </td>
                            <td style="width: 8%; text-align: right;">
                                <?= $form->field($model2, 'prev_surcharge[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield', 'id' => 'journalentry-sub_loan_prev_surcharge_'.$key, 'style' => 'text-align: right', 'value' => $value->prev_surcharge])->label(false) 
                                ?>
                            </td>
                            <td style="width: 8%; text-align: right;">
                                <?= $form->field($model2, 'surcharge[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield surcharge', 'id' => 'journalentry-sub_loan_surcharge_'.$key, 'style' => 'text-align: right', 'value' => $value->current_surcharge])->label(false) 
                                ?>
                            </td>
                        </tr>
                        <?php 
                            $total_principal = $total_principal + $value->actual_principal;
                            $total_interest = $total_interest + $value->actual_interest;
                            $total_surcharge = $total_surcharge + $value->actual_surcharge;
                            $total_remittance = $total_remittance + $value->actual_remittance;
                            $total_current_surcharge = $total_current_surcharge + $value->current_surcharge;
                        ?>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="5">T O T A L :</td>
                            <td style="text-align: right; font-weight: bold;">
                                <?= $form->field($model2, 'total_loan_remittance[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield', 'style' => 'text-align: right', 'id' => 'total_remit', 'value' => $total_remittance])->label(false) 
                                ?>
                            </td>
                            <td>
                                <?= $form->field($model2, 'total_loan_principal[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield', 'style' => 'text-align: right', 'id' => 'total_loan_principal', 'value' => $total_principal])->label(false) 
                                ?>
                            </td>
                            <td>
                                <?= $form->field($model2, 'total_loan_interest[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield', 'style' => 'text-align: right', 'id' => 'total_loan_interest', 'value' => $total_interest])->label(false) 
                                ?>
                            </td>
                            <td>
                                <?= $form->field($model2, 'surcharge_total[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield surcharge_total', 'style' => 'text-align: right', 'id' => 'total_surcharge_payment', 'value' => $total_surcharge])->label(false)
                                ?>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <?= $form->field($model2, 'total_loan_surcharge[]', ['options' => ['tag' => false]])->textInput(['class' => 'new-textfield loan_surcharge', 'style' => 'text-align: right', 'id' => 'total_loan_surcharge', 'value' => $total_current_surcharge])->label(false) 
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
          </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs("
    $('tbody th').css('text-align', 'center');
"); ?>

<script>
function particulars() 
{
    $('#particulars').show();
    document.getElementById('attachments').style.display = "none";
    document.getElementById('myTable').style.display = "none";
}

function attachments() 
{
    document.getElementById('particulars').style.display = "none";
    // document.getElementById('attachments').style.display = "block";
    // document.getElementById('attachments').style.width = "100%";
    $('#attachments').show();
    document.getElementById('myTable').style.display = "none";
}

function accounting_entry() 
{
    document.getElementById('particulars').style.display = "none";
    document.getElementById('attachments').style.display = "none";
    $('#myTable').show();
}

function myFunction() {
    var tr = document.getElementById("myTr");
    var cln = tr.cloneNode(true);
    // document.getElementById("myTable").appendChild(cln);
    cln.id = "myTable"; // change id or other attributes/contents
    // table.appendChild(clone); // add new row to end of table
    document.getElementById("myTable").appendChild(cln);
}

function myFunction1() {
    var tr1 = document.getElementById("myTr1");
    var cln1 = tr1.cloneNode(true);
    // document.getElementById("myTable").appendChild(cln);
    cln1.id = "myTable1"; // change id or other attributes/contents
    // table.appendChild(clone); // add new row to end of table
    document.getElementById("myTable1").appendChild(cln1);
}

window.onload = function()
{
    $(document).on("change", "select[id='id_3']", function () { 
        // alert($(this).val())
       // $modal = $('#myModal');
        if($(this).val() == '11210' || $(this).val() == '11350' || $(this).val() == '11130' || $(this).val() == '11110')
        {
            //document.getElementById('sub_led_table').style.display = "block";
            $('#subModal').modal('show');
        }
    });

    $(document).on("keyup", ".trigger-remittances", function () {
        
        var fieldId = $(this).prop('id'),
            rowNoParts = fieldId.split('_'),
            rowNo = rowNoParts[rowNoParts.length - 1];

        var interest = $("#journalentry-sub_loan_interest_" + rowNo).val(),
            remittance = $("#remittance_" + rowNo).val(),
            total_amortization = $("#total_amortization_" + rowNo).val(),
            principal = parseFloat(remittance) - parseFloat(interest),
            prev_surcharge = $("#journalentry-sub_loan_prev_surcharge_" + rowNo).val(),
            surcharge_payment = $("#journalentry-surcharge_payment_" + rowNo).val(),
            deficit = parseFloat(total_amortization) - (parseFloat(principal) + parseFloat(interest)),
            new_surcharge = ((parseFloat(deficit) * .1) + (parseFloat(prev_surcharge)) * .1),
            interest2 = $("#interest_2_" + rowNo).val(),
            monthly_principal = $("#sub_monthly_principal_" + rowNo).val();

        // $("#journalentry-sub_loan_principal_" + rowNo).val(principal.toFixed(2));

        if(deficit < 0)
        {

            deficit = 0.00;
            $("#journalentry-sub_loan_deficit_" + rowNo).val(parseFloat(deficit));

            // new_surcharge = ((parseFloat(prev_surcharge) - (parseFloat(surcharge_payment))) * .1);
            // $("#journalentry-sub_loan_surcharge_" + rowNo).val(new_surcharge.toFixed(2));

            if(principal > monthly_principal)
            {
                var differencial = principal - monthly_principal;

                if(differencial > prev_surcharge)
                {
                    var differencial2 = differencial - prev_surcharge,
                        new_principal = parseFloat(monthly_principal) + parseFloat(differencial2);

                    new_surcharge = 0.00;
                    $("#journalentry-sub_loan_surcharge_" + rowNo).val(new_surcharge);

                    $("#journalentry-surcharge_payment_" + rowNo).val(prev_surcharge);
                    $("#journalentry-sub_loan_principal_" + rowNo).val(new_principal.toFixed(2));
                    $("#journalentry-sub_loan_interest_" + rowNo).val(interest2.toFixed(2));

                }

                else
                {
                    new_surcharge = ((parseFloat(prev_surcharge) - (parseFloat(differencial))) * .1);
                    $("#journalentry-sub_loan_surcharge_" + rowNo).val(new_surcharge.toFixed(2));

                    var new_principal = parseFloat(monthly_principal);
                    $("#journalentry-sub_loan_principal_" + rowNo).val(new_principal.toFixed(2));
                    $("#journalentry-surcharge_payment_" + rowNo).val(differencial.toFixed(2));
                    $("#journalentry-sub_loan_interest_" + rowNo).val(interest2.toFixed(2));

                }
            }
        }

        else
        {
            if(remittance == 0.00 || remittance == null)
            {
                $("#journalentry-sub_loan_principal_" + rowNo).val(0.00);
                $("#journalentry-sub_loan_interest_" + rowNo).val(0.00);
                $("#journalentry-surcharge_payment_" + rowNo).val(0.00);
                $("#journalentry-sub_loan_deficit_" + rowNo).val(total_amortization);

                principal = 0.00;
                interest = 0.00;
            }

            else
            {
                var new_principal = parseFloat(principal);
                $("#journalentry-sub_loan_principal_" + rowNo).val(new_principal.toFixed(2));
                $("#journalentry-sub_loan_interest_" + rowNo).val(parseFloat(interest2).toFixed(2));
                $("#journalentry-surcharge_payment_" + rowNo).val(0.00);
                $("#journalentry-sub_loan_deficit_" + rowNo).val(parseFloat(deficit).toFixed(2));
            }
        }
        
        //deficit = parseFloat(total_amortization) - (parseFloat(principal) + parseFloat(interest)),
        new_surcharge = ((parseFloat(deficit) * .1) + (parseFloat(prev_surcharge)) * .1),
        $("#journalentry-sub_loan_surcharge_" + rowNo).val(new_surcharge.toFixed(2));
    });


    $(document).on("keyup", ".remit", function() {

        var sum = 0;
        $(".principal_amount").each(function(){
            sum += +$(this).val();
        });

        var remitsum = 0;
        $(".trigger-remittances").each(function(){
            remitsum += +$(this).val();
        });

        $("#total_loan_principal").val(sum.toFixed(2));
        $("#receivable_id").val(sum.toFixed(2));
        $("#total_remit").val(remitsum.toFixed(2));

        var interest_total = 0;
        $(".trigger-interest").each(function(){
            interest_total += +$(this).val();
        });
        $("#total_loan_interest").val(interest_total.toFixed(2));

        var surcharge_sum = 0;
        $(".surcharge").each(function(){
            surcharge_sum += +$(this).val();
        });

        $("#total_loan_surcharge").val(surcharge_sum.toFixed(2));
        $("#id_credit").val(surcharge_sum.toFixed(2));

        var surcharge_payment = 0;
        $(".surcharge_payment").each(function(){
            surcharge_payment += +$(this).val();
        });

        $("#total_surcharge_payment").val(surcharge_payment.toFixed(2));
    });

    $(document).on("click", "#trigger_compute", function() {

        var sum = 0;
        $(".principal_amount").each(function(){
            sum += +$(this).val();
        });

        var remitsum = 0;
        $(".trigger-remittances").each(function(){
            remitsum += +$(this).val();
        });

        $("#total_loan_principal").val(sum.toFixed(2));
        $("#receivable_id").val(sum.toFixed(2));
        $("#total_remit").val(remitsum.toFixed(2));

        var interest_total = 0;
        $(".trigger-interest").each(function(){
            interest_total += +$(this).val();
        });
        $("#total_loan_interest").val(interest_total.toFixed(2));

        var surcharge_sum = 0;
        $(".surcharge").each(function(){
            surcharge_sum += +$(this).val();
        });

        $("#total_loan_surcharge").val(surcharge_sum.toFixed(2));
        $("#id_credit").val(surcharge_sum.toFixed(2));

        var surcharge_payment = 0;
        $(".surcharge_payment").each(function(){
            surcharge_payment += +$(this).val();
        });

        $("#total_surcharge_payment").val(surcharge_payment.toFixed(2));
    });

        $(document).on("click", "#trigger_total", function() {

            var total_principal_trig = $("#total_loan_principal").val()
            var total_interest_trig = $("#total_loan_interest").val()
            var surcharge_income = $("#total_surcharge_payment").val()

            $("#receivable_id").val(total_principal_trig);
            $("#id_credit").val(total_interest_trig);
             $("#id_credit_surcharge").val(surcharge_income);

            var sum_debit = 0;
            //iterate through each textboxes and add the values
            $(".id_debit").each(function() {

                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum_debit += parseFloat(this.value);
                }

            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#totalDebit").val(sum_debit.toFixed(2));

            var sum_credit = 0;
            //iterate through each textboxes and add the values
            $(".id_credit").each(function() {

                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum_credit += parseFloat(this.value);
                }

            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#totalCredit").val(sum_credit.toFixed(2));

        });

        $(document).on("click", "#trigger_sub_total", function() {

            var total_principal_trig = $("#total_loan_principal").val()
            var total_interest_trig = $("#total_loan_interest").val()
            var sub_debit = $("#sub_debit_id").val()

            $("#receivable_id").val(total_principal_trig);
            $("#id_credit").val(total_interest_trig);
            $("#id_debit_amount").val(sub_debit);

            var sum_debit = 0;
            //iterate through each textboxes and add the values
            $(".id_debit").each(function() {

                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum_debit += parseFloat(this.value);
                }

            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#totalDebit").val(sum_debit.toFixed(2));

            var sum_credit = 0;
            //iterate through each textboxes and add the values
            $(".id_credit").each(function() {

                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum_credit += parseFloat(this.value);
                }

            });
            //.toFixed() method will roundoff the final sum to 2 decimal places
            $("#totalCredit").val(sum_credit.toFixed(2));

        });

function calculateSum1() {

    var sum = 0;
    //iterate through each textboxes and add the values
    $(".id_debit").each(function() {

        //add only if the value is number
        if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#totalDebit").val(sum.toFixed(2));
}

//Auto Sum .....................

//$(".id_debit").each(function() {

        $('.id_debit').on('keyup',function(){
            calculateSum1();
        });
    //});

function calculateSum1() {

    var sum = 0;
    //iterate through each textboxes and add the values
    $(".id_debit").each(function() {

        //add only if the value is number
        if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#totalDebit").val(sum.toFixed(2));
}

$(".id_credit").each(function() {

    $(this).keyup(function(){
        calculateSum();
    });
});

function calculateSum() {

    var sum = 0;
    //iterate through each textboxes and add the values
    $(".id_credit").each(function() {

        //add only if the value is number
        if(!isNaN(this.value) && this.value.length!=0) {
            sum += parseFloat(this.value);
        }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#totalCredit").val(sum.toFixed(2));
}
}
</script>