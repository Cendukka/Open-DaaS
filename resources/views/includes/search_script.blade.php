{{-- Script runs the query whenever text or date filters change, then outputs the found reports--}}
<script type="text/javascript">
    function search(){
        $search = $('#search').val();
        $from = $('#from-date').val() ? $('#from-date').val() : '';
        $to = $('#to-date').val() ? $('#to-date').val() : '';
        $.ajax({
            type : 'get',
            url : '{{URL::to(trim(url()->current(),'/').'/search')}}',
            data:{'search':$search,'from':$from,'to':$to},
            success:function(data){
                $('#searchtable').html(data);
            }
        });
    }

    $(document).ready(search);
    $('#search').on('keyup',search);
    $('#search').on('change',search);
    $('#from-date').on('change',search);
    $('#to-date').on('change',search);

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>