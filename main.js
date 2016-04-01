function send_post(){
	var hr;
	if (window.XMLHttpRequest) {
    // code for modern browsers
    hr= new XMLHttpRequest();
    } 
    else {
    // code for IE6, IE5
    hr = new ActiveXObject("Microsoft.XMLHTTP");
  }
	var url = "send_post.php";
	var fn = document.getElementById("post").value;
	var vr="post="+fn;
	hr.open("POST",url,true);
	hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	hr.onreadystatechange = function(){
		if(hr.readyState==4 && hr.status==200){
            var return_data = hr.responseText;
            document.getElementById("status").innerHTML = return_data;
		}
	}
	hr.send(vr);
	document.getElementById("status").innerHTML="processing...";
}
$('#an').show(output1+": ")
 		$('#an').show(output2+"<br>")