function setFeed(q)
{
	if (q.length==0)
	{ 
		document.getElementById("main").innerHTML="";
		return;
	}
	
	var xmlhttp=new XMLHttpRequest();

	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
            var main = document.getElementById("main");
			var title = document.getElementById("title");
			main.innerHTML=xmlhttp.responseText;
			title.innerHTML = document.getElementById("feed_title").innerHTML;
            document.title = document.getElementById('feed_title').innerHTML;
			var feed_header = document.getElementById("feed_header");
			main.removeChild(feed_header);
            
            //Change url without reloading
            history.pushState({feedTitle:document.title}, document.title, 'index.php');
		}	
	};
	xmlhttp.open("GET","xml/getrss.php?q="+q, true);
	xmlhttp.send();
}    