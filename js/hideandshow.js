$(document).ready(function(){
    $(".FSEC-tab").click(function(){
        $("#FSEC").fadeIn();
        $("#1st").hide();
        $("#during").hide();
        $("#Issuances").hide();

        $("#FSEC").css("color:blue");
        $("#1st").css("color:black");
        $("#during").css("color:black");
        $("#Issuances").css("color:black");
    });
    $(".1st-tab").click(function(){
        $("#FSEC").hide();
        $("#1st").fadeIn();
        $("#during").hide();
        $("#Issuances").hide();  

        $("#FSEC").css("color:black");
        $("#1st").css("color:blue");
        $("#during").css("color:black");
        $("#Issuances").css("color:black");

      });
    $(".during-tab").click(function(){
        $("#FSEC").hide();
        $("#1st").hide();
        $("#during").fadeIn();
        $("#Issuances").hide();   
        
        $("#FSEC").css("color:black");
        $("#1st").css("color:black");
        $("#during").css("color:blue");
        $("#Issuances").css("color:black");
    });
    $(".Issuances-tab").click(function(){
        $("#FSEC").hide();
        $("#1st").hide();
        $("#during").hide();
        $("#Issuances").fadeIn();   

        $("#FSEC").css("color:black");
        $("#1st").css("color:black");
        $("#during").css("color:black");
        $("#Issuances").css("color:blue");
    });
});