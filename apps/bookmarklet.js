javascript:
var d=document,
w=window,
e=w.getSelection,
k=d.getSelection,
x=d.selection,
s=(e?e():(k)?k():(x?x.createRange().text:0)),
f='http://www.tumblr.com/share',
l=d.location,
e=encodeURIComponent,
p='?v=3&u='+e(l.href) +'&t='+e(d.title) +'&s='+e(s),
u=f+p;
try{
    if(!/^(.*\.)?tumblr[^.]*$/.test(l.host)) throw(0);
    tstbklt();
}catch(z){
    a =function(){
    if(!w.open(u,'t','toolbar=0,resizable=0,status=1,width=450,height=430'))
    l.href=u;
};
if(/Firefox/.test(navigator.userAgent))
    setTimeout(a,0);
    else a();
}void(0)

//do this
//http://www.tumblr.com/share?v=3&u=http%3A%2F%2Fmarklets.com%2Fshow%2Brss%2Bfeed.aspx&t=Show%20RSS%20Feed%20Bookmarklet%20%7C%20Bookmarklet%20Search%20Engine&s=



//<a href="javascript:var d=document,w=window,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),f='http://www.tumblr.com/share',l=d.location,e=encodeURIComponent,p='?v=3&u='+e(l.href) +'&t='+e(d.title) +'&s='+e(s),u=f+p;try{if(!/^(.*\.)?tumblr[^.]*$/.test(l.host))throw(0);tstbklt();}catch(z){a =function(){if(!w.open(u,'t','toolbar=0,resizable=0,status=1,width=450,height=430'))l.href=u;};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else a();}void(0)" onclick="return explain_bookmarklet();" id="bookmarklet_button" class="chrome huge" style="position:relative" title="Pour installer, faites simplement glisser ce bouton dans votre barre de favoris.">Partager sur Tumblr</a>


// javascript:(function(){document.body.appendChild(document.createElement('script')).src='http://savanttools.com/feedhelp-bookmarklet.js';})();


// This bookmarklet is hosted on the server so that future improvements will benefit everyone that has added the bookmarlet
//   Since the functionality of this bookmarket depends on feedhelp.asp, which is also hosted on this server, hosting the script  on the server also seems to be reasonable
({
    addURL:function(aURL){
        var url="http://SavantTools.com/feedhelp.asp?feed="+encodeURIComponent(aURL);location.href=url;
    },
    getFeedURL:function(e,aDocument){
        var j=e;
        var c=aDocument.location;
        if(e.indexOf("/")!=0){
            var d=c.pathname.split("/");
            d[d.length-1]=e;
            j=d.join("/")
        }
        return c.protocol+"//"+c.hostname+j;
    },
    checkForFeeds:function(){
        var f=false;
        var m=document.getElementsByTagName("link");
        for(var g=0,a;a=m[g];g++){
            var h=a.getAttribute("type");
            var i=a.getAttribute("rel");
            if(h&&h.match(/[\+\/]xml$/)&&i&&i=="alternate"){
                var b=a.getAttribute("href");
                if(b.indexOf("http")!=0){
                    b=this.getFeedURL(b,document);
                }
                this.addURL(b);
                f=true;
                break
            }
        }
        if(!f)
            alert("Oops. Can't find a feed.");
    }
}).checkForFeeds();


// chrome extension
//https://developer.chrome.com/extensions/manifest.html
//https://developer.chrome.com/extensions/getstarted.html
//switch icon -> http://developer.chrome.com/extensions/browserAction.html
//wappalyzer
//https://github.com/ElbertF/Wappalyzer/tree/master/drivers/chrome

//get link[type="application/rss+xml"]