
function buttons(){
    var country= document.getElementById("lookup");
    var city= document.getElementById("lookup1");
    country.addEventListener("click",function(e) {
        e.preventDefault();
        var text1 = (document.getElementById("country").value);
        $.ajax({
            type: 'GET',
            url: `world.php?country=${text1}`,
            success: function (data) {
                $("#result").html(data);
            }
        });        
    });
    city.addEventListener("click",function(e) {
        e.preventDefault();
        var text1 = (document.getElementById("country").value);
        $.ajax({
            type: 'GET',
            url: `world.php?country=${text1}&context=cities`,
            success: function (data) {
                $("#result").html(data);
            }
        });        
    });
}

window.onload=buttons;