<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
    function search(){
        $search = $('#search').val();
        $from = $('#from-date').val() ? $('#from-date').val() : '';
        $to = $('#to-date').val() ? $('#to-date').val() : '';
        $.ajax({
            type : 'get',
            url : '{{URL::to(trim($_SERVER['REQUEST_URI'],'/').'/search')}}',
            data:{'search':$search,'from':$from,'to':$to},
            success:function(data){
                $('.ajaxContent').html(data);
            }
        });
    }
    $(document).ready(search);
    $('#search').on('keyup',search());
    $('#from-date').on('keyup',search());
    $('#to-date').on('keyup',search());
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
