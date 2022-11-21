$(function() {

    console.log("Jquery ready!");

    // Delete Album
    $("a.delete-album").on( 'click', function(e){
        e.preventDefault();
        if(confirm("Are you sure you want to delete this?")){
            $("form#delete-album").submit();
        }
        else{
            return false;
        }
    });

    // Delete Image
    $("a.delete-image").on( 'click', function(e){
        e.preventDefault();
        if(confirm("Are you sure you want to delete this?")){
            $("form#delete-image").submit();
        }
        else{
            return false;
        }
    });


});
