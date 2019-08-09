<script type="text/javascript">
    function addMat(){
        $.ajax({
            type: 'GET',
            url : "/companies/{{$company->company_id}}/manage/issues/new_details",
            success : function (data) {
                $("#details").append(data);
            }
        });
    }
    $('#removeMat').on('click',(function(){
        if($("#details").children("div").length > 1){
            $("#details").children("div:last").remove();
            $("#details").children("br:last").remove();
            $("#details").children("p:last").remove();
        }
    }));
    function toDestination(){
        var $issueType = $("#type").val();
        if($issueType == 1){ // Sisäinen siirto
            $("#to_microlocation").show();
            $("#to_company").hide();
        }
        else if($issueType == 2){ // Ulkoinen siirto
            $("#to_microlocation").hide();
            $("#to_company").show();
        }
        else{
            $("#to_microlocation").hide();
            $("#to_company").hide();
        }
    }
    function clearMaterials(){
        var $ml_id = $("#from_microlocation").val();
        $.ajax({
            type: "get",
            url: '{{URL::to('/companies/'.$company->company_id.'/manage/issues/inventory')}}',
            data: {'ml_id':$ml_id},
            success:function(data){
                selects = $(".material-select").children('option');
                selects.each(function(k,v){
                    if($.inArray($(this).val(),Object.keys(data)) >= 0){
                        $(this).prop("disabled", false).prop("hidden", false);
                        $(this).text($(this).text().substring(0,$(this).text().indexOf("["))+' ['+data[$(this).val()]+']');
                    }
                    else{
                        $(this).prop("disabled", true).prop("hidden", true);
                    }
                });
            }
        })
    }

    $('#addMat').on('click',function(){
        addMat();
        clearMaterials();
    });

    // Show/hide To Microlocation depending on issue type
    $(document).ready(toDestination);
    // $(document).ready(details);
    $('#type').on('change',toDestination);
    $('#type').on('change',details);




    // Clear all materials if From Microlocation is changed
    $('#from_microlocation').on('change',function(){
        if($("#details").children("div").length == 0){
            addMat();
            clearMaterials();
        }
    });

    // Add first material, if none exists
    $(document).ready(function(){
        if($("#details").children("div").length == 0){
            addMat();
            clearMaterials();
        }
    });

    $(document).ready(clearMaterials);
    $('#from_microlocation').on('change',clearMaterials);
</script>