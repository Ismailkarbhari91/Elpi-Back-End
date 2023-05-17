$(document).ready(function(){
    $(".register").hide();
    $(".tab-btns").click(function(){
        $(".tab-content").hide();
        $(".tab-btns").removeClass("tab-active");
        $(this).addClass("tab-active");
        $($(this).attr("data-id")).toggle();
    });

    $("#navbarDropdownMenuLink").click(function(){
        $("ul.dropdown-menu").toggle();
    });

    // $("#navbarDropdownMenuLink").mouseover(function(){
    //     $("ul.dropdown-menu").show();
    // });
    // $("ul.dropdown-menu").mouseout(function(){
    //     $("ul.dropdown-menu").hide();
    // });

    // $("#start_btn").click(function(e){
    //     e.preventDefault();
        

    // });

    
});