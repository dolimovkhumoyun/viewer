<style type="text/css">
	
	#mnav {
    margin-left: -30px;
    margin-right: -30px;
}
#mnav li {
    float: left;
    list-style: none;
    margin:0 10px;/*Keeping 10px space between each nav element*/
}
#mnav li a,/*These can all be merged into a single style*/
#mnav li a:link,
#mnav li a:visited,
#mnav li a:hover,
#mnav li a:active {
    text-decoration: none;
}
#mnav li ul {
    display: none;/*This is the default state.*/
    z-index: 9999;
    position: absolute;
    width: 400px;
    max-height:63px;/*The important part*/
    overflow-y:auto;/*Also...*/
    overflow-x:hidden;/*And the end of the important part*/
    margin: 0px;
    padding-left:5px;/*Removing the large whitespace to the left of list items*/
    border: 1px solid #ddd;
}
#mnav li:hover ul, #mnav li.sfhover ul {
    display:block;/*This is the hovered state*/
}
#mnav li ul li a, #mnav li ul li a:link, #mnav li ul li a:visited {
    display: block;
    margin: 0;
    text-decoration: none;
    z-index: 9999;
    border-bottom: 1px dotted #ccc;
    width:400px;
}
#mnav li ul li a:hover, #mnav li ul li a:active {
    display: block;
    margin: 0;
    text-decoration: none;
}

</style>


<ul id="mnav">

<li><a><b>Home</b></a>
</li>
<li><a><b>SQL Server vs Oracle</b></a>
 <ul>

<li><a>Basic SQL : Declare variables and assign values</a></li>

<li><a>Basic SQL : Inner Join, Outer Join and Cross Join</a></li>

<li><a>Basic SQL : Padding and Trimming</a></li>

<li><a>Basic SQL : Union,Except/Minus,Intersect</a></li>

<li><a style="border-bottom-color: currentColor; border-bottom-width: 0px; border-bottom-style: none;">Update from Select</a></li>

</ul>
</li>

<li><a href="#"><b>SSIS</b></a>
 <ul>
<li><a>Coalesce in SSIS</a></li>
<li><a >Universal CSV Generator</a></li>
<li><a >Parsing a row into multiple in CSV</a></li>


<li><a style="border-bottom-color: currentColor; border-bottom-width: 0px; border-bottom-style: none;" >XML Task in SSIS</a></li>
</ul>
 </li></ul>
