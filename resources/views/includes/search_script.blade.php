<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
    function search(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to(trim($_SERVER['REQUEST_URI'],'/').'/search')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            }
        });
    }
    $(document).ready(search)
    $('#search').on('keyup',search)
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>