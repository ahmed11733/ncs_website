<div class="modal fade" id="{{$modalID}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="action_form" method="{{isset($modalMethod)?$modalMethod:'post'}}" action="{{ isset($modalRoute) ? $modalRoute : '' }}" enctype="multipart/form-data">
            @csrf
            {{ isset($modalMethodPutOrDelete) ? $modalMethodPutOrDelete : ''}}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{$modalTitle}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        {{$modalContent}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تأكيد</button>
                </div>
            </div>
        </form>
    </div>
</div>
