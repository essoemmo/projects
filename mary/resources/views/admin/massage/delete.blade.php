<form action="{{route('converstions.destroy',$id)}}" method="post">
    {{method_field('delete')}}
    {{csrf_field()}}
    <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
</form>

<script>
    $('.delete').click(function (e) {

        var that = $(this)

        e.preventDefault();

        var n = new Noty({
            text: "{{_i('Are you sure ?')}}",
            type: "warning",
            killer: true,
            buttons: [
                Noty.button("{{_i('yes')}}", 'btn btn-success mr-2', function () {
                    that.closest('form').submit();
                }),

                Noty.button("{{_i('no')}}", 'btn btn-primary mr-2', function () {
                    n.close();
                })
            ]
        });

        n.show();

    });//end of delete
</script>

