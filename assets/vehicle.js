$(function(){
    $(".delete_form_submit_btn").on('click',function(event){
        event.preventDefault();
        if(confirm("Are you sure you want to delete this vehicle?")){
            $(".delete_form_submit_btn").parent().submit();
        }
    });
})