if(!window.all){document.attachEvent("onreadystatechange",function(){if(document.readyState=="complete"){var a=document.getElementById("canvas");var c=a.outerHTML;var b=document.createElement(c);a.parentNode.replaceChild(b,a);a=b;a.getContext=function(){if(this.cont){return this.cont}return this.cont=new PMD_2D(this)};a.style.width=a.attributes.width.nodeValue+"px";a.style.height=a.attributes.height.nodeValue+"px"}});function convert_style(c){var a=[];a=c.match(/.*\((\d*),(\d*),(\d*),(\d*)\)/);for(var b=1;b<=3;b++){a[b]=(a[b]*1).toString(16).length<2?"0"+(a[b]*1).toString(16):(a[b]*1).toString(16)}return["#"+a[1]+a[2]+a[3],1]}function PMD_2D(a){this.element_=a;this.pmd_arr=[];this.strokeStyle;this.fillStyle;this.lineWidth;this.closePath=function(){this.pmd_arr.push({type:"close"})};this.clearRect=function(){this.element_.innerHTML="";this.pmd_arr=[]};this.beginPath=function(){this.pmd_arr=[]};this.moveTo=function(c,b){this.pmd_arr.push({type:"moveTo",x:c,y:b})};this.lineTo=function(c,b){this.pmd_arr.push({type:"lineTo",x:c,y:b})};this.arc=function(h,f,g,e,c,d){if(!d){var k=e;e=c;c=k}var i=h+(Math.cos(e)*g);var l=f+(Math.sin(e)*g);var b=h+(Math.cos(c)*g);var j=f+(Math.sin(c)*g);this.pmd_arr.push({type:"arc",x:h,y:f,radius:g,xStart:i,yStart:l,xEnd:b,yEnd:j})};this.rect=function(d,c,e,b){this.moveTo(d,c);this.lineTo(d+e,c);this.lineTo(d+e,c+b);this.lineTo(d,c+b);this.closePath()};this.fillRect=function(d,c,e,b){this.beginPath();this.moveTo(d,c);this.lineTo(d+e,c);this.lineTo(d+e,c+b);this.lineTo(d,c+b);this.closePath();this.stroke(true)};this.stroke=function(e){var f=[];var b=convert_style(e?this.fillStyle:this.strokeStyle);var c=b[0];f.push("<v:shape",' fillcolor="',c,'"',' filled="',Boolean(e),'"',' style="position:absolute;width:10;height:10;"',' coordorigin="0 0" coordsize="10 10"',' stroked="',!e,'"',' strokeweight="',this.lineWidth,'"',' strokecolor="',c,'"',' path="');for(var d=0;d<this.pmd_arr.length;d++){var g=this.pmd_arr[d];if(g.type=="moveTo"){f.push(" m ");f.push(Math.floor(g.x),",",Math.floor(g.y))}else{if(g.type=="lineTo"){f.push(" l ");f.push(Math.floor(g.x),",",Math.floor(g.y))}else{if(g.type=="close"){f.push(" x ")}else{if(g.type=="arc"){f.push(" ar ");f.push(Math.floor(g.x-g.radius),",",Math.floor(g.y-g.radius)," ",Math.floor(g.x+g.radius),",",Math.floor(g.y+g.radius)," ",Math.floor(g.xStart),",",Math.floor(g.yStart)," ",Math.floor(g.xEnd),",",Math.floor(g.yEnd))}}}}}f.push(' ">');f.push("</v:shape>");this.element_.insertAdjacentHTML("beforeEnd",f.join(""));this.pmd_arr=[]}}};