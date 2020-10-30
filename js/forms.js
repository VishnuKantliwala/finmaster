


//Subscribe form

$('#formSubscribe').submit(function(){
    return false;
    });
    $('#submitSubscribe').click(function(){
    //alert('hello');
    $.post( 
    
    $('#formSubscribe').attr('action'),
    $('#formSubscribe :input').serializeArray(),
    function(resultSub){
    
    if(resultSub!='0')
    {
        $('.subscribe-form').html('<center><h2>'+resultSub+'</h2></center>');
        
    }
    
    }
    
    );
    });
    
    //contact form
    
    $('#contactForm').submit(function(){
    return false;
    });
    $('#submitContact').click(function(){
    //alert('hello');
    $.post( 
    
    $('#contactForm').attr('action'),
    $('#contactForm :input').serializeArray(),
    function(result2){
    //alert('click'); 
    $('#resultForm').html(result2);
    }
    );
    });
    
    
    
    //Other forms
                      