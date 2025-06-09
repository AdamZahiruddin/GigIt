var postNextStatus = false;

$('#btn-next').on('click', function(){
    if(postNextStatus == false){
        postNextStatus = true
        $('#create-part1').val('unactive');
        $('#create-part2').val('active');
        $('#btn-create').val('active');
        $('#btn-next').text('Back');
    }
    else{
        postNextStatus = false;
        $('#create-part1').val('active');
        $('#create-part2').val('unactive');
        $('#btn-create').val('unactive');
        $('#btn-next').text('Next');
    }
})