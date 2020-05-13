<div class="modal-body p-b-0">
    <form id="send_{{ $type }}" data-parsley-validate>
        @csrf
        @honeypot {{--prevent form spam--}}
        <input type="hidden" name="type" form="send_{{ $type }}" class="send_type" value="{{ $type }}">
        <input type="hidden" form="send_{{ $type }}" class="user_email" name="email" value="{{ $contact->email }}">
        <div class="row">
            <div class="col-sm-12">
                <div>
                    <label class="form-control-label">{{ _i('Message') }}</label>
                    <textarea name="message" required form="send_{{ $type }}"
                              class="form-control message"
                              placeholder="{{ _i('Enter your Message') }}"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary ml-2"
            data-dismiss="modal">{{ _i('Close') }}</button>
    <button type="submit" class="btn btn-primary"
            form="send_{{ $type }}">{{ _i('Send') }}</button>
</div>
