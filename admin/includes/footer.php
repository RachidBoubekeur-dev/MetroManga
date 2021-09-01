<style>
@media screen and (min-width: 1200px)
{
	footer
	{
		height: 120px;
		background-color: rgb(40,40,40);
		width: 100%;
		margin: 0%;
		z-index: 10005;
	}
	
	footer ul
	{
		display: inline-block;
		list-style: none;
		width: 93.5%;
		text-align: center;
	}
	
	footer ul a
	{
		text-decoration: none;
		color: white;
	}
	
	footer ul li
	{
		display: inline-block;
		border-left: 1px solid white;
		border-right: 1px solid white;
		font-size: 2em;
		width: 19%;
		text-align: center;
		font-family: 'Cookie';
		transition: all 0.3s;
	}
	
	footer ul li:hover
	{
		transform: scale(1.15);
	}
	
	footer hr
	{
		border: 2px solid rgb(30,30,30);
		width: 95%;
		margin-top: 0%;
		margin-bottom: 0%;
	}
	
	footer p
	{
		font-family: 'Cookie';
		color: white;
		text-align: center;
		margin: 0%;
		padding-top: 6px;
		font-size: 2em;
	}
}
</style>
<footer>
	<ul>
		<a href="../#"><li>Contact</li></a>
		<a href="../#"><li>F.A.Q</li></a>
		<a href="../#"><li>Mentions Légales</li></a>
		<a href="../#"><li>Règlement</li></a>
		<a href="../#"><li>Staff</li></a>
	</ul>
	<hr />
	<p>Copyright © MetroManga - <?php echo date("Y"); ?></p>
</footer>