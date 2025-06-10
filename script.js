var postNextStatus = false;

$('#btn-next').on('click', function(){
    if(postNextStatus == false){
        activate1();
    }
    else{
        activate2();
    }
})

$('#btn-create').on('click', function(){

    $('#create-part1 .contain-input input').each(function(){
        if($(this).val() == '') {
            activate2();
        }
    })
})

function activate1(){
    postNextStatus = true
    $('#create-part1').attr('value', 'unactive');
    $('#create-part2').attr('value', 'active');
    $('#btn-create').val('active');
    $('#btn-next').text('Back');
}

function activate2(){
    postNextStatus = false;
    $('#create-part1').attr('value', 'active');
    $('#create-part2').attr('value', 'unactive');
    $('#btn-create').val('unactive');
    $('#btn-next').text('Next');
}