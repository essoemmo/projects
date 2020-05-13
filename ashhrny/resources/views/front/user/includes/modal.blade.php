<div class="modal fade text-center" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content justify-content-center">
            <div class="modal-header">
                <h5 class="modal-title "
                    id="exampleModalCenterTitle">
                    @if(setting() != null)
                        {{ setting()->total_title }}
                    @else
                        {{ _i('Total Cost') }}
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn grade btn-lg my-3"><span
                        class="total"></span> {{ _i('SAR') }}</button>
                @if(setting() != null)
                    <p>{{ setting()->warning_description }}</p>
                @else
                    <p>{{ _i('Advertising is not made until after the amount has been transferred to the Ashhurni website account As it is the mediator between the member and the famous') }}</p>
                    <p>{{ _i('After completing the announcement, you must evaluate within 24 hours, in order for us to deposit the amount In the calculation of the celebrity, and if the evaluation period exceeds 24 hours, and the evaluation has not been completed The amount is transferred to the account of the celebrity and the evaluation is considered positive') }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grade showModal">{{ _i('Agree') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-center" id="payModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content justify-content-center">
            <div class="modal-header">
                <h5 class="modal-title "
                    id="exampleModalCenterTitle">
                    {{ _i('Your Request Is Pending Approval') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ _i('You will be notified of the invoice details to complete the payment via e-mail and notices within the site') }}</p>
            </div>
            <div class="modal-footer">
                <button type="submit" form="myForm1"
                        class="btn grade pay">{{ _i('Pay') }}</button>
            </div>
        </div>
    </div>
</div>
