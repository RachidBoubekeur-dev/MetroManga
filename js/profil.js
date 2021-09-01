document.querySelector("#pseudonavigation").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockprofil')).display=='none')
	{
		document.querySelector("#blockprofil").style.display="block";
		document.querySelector("#pseudonavigation").style.opacity="1";
		document.querySelector("#pseudonavigation").style.cursor="default";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	else
	{
		document.querySelector("#blockprofil").style.display="block";
		document.querySelector("#pseudonavigation").style.opacity="1";
		document.querySelector("#pseudonavigation").style.cursor="default";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
}

document.querySelector("#actualitenavigation").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockactualitenavigation')).display=='none')
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#blockactualitenavigation").style.display="block";
		document.querySelector("#actualitenavigation").style.opacity="1";
		document.querySelector("#actualitenavigation").style.cursor="default";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	else
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#blockactualitenavigation").style.display="block";
		document.querySelector("#actualitenavigation").style.opacity="1";
		document.querySelector("#actualitenavigation").style.cursor="default";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
}

document.querySelector("#abonnementnavigation").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockabonnementnavigation')).display=='none')
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#blockabonnementnavigation").style.display="block";
		document.querySelector("#abonnementnavigation").style.opacity="1";
		document.querySelector("#abonnementnavigation").style.cursor="default";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	else
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#blockabonnementnavigation").style.display="block";
		document.querySelector("#abonnementnavigation").style.opacity="1";
		document.querySelector("#abonnementnavigation").style.cursor="default";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
}

document.querySelector("#notificationnavigation").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blocknotificationnavigation')).display=='none')
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#blocknotificationnavigation").style.display="block";
		document.querySelector("#notificationnavigation").style.opacity="1";
		document.querySelector("#notificationnavigation").style.cursor="default";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="block";
		document.querySelector("#blockactualitepagenoir").style.display="block";
		document.querySelector("#blockabonnementpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	else
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#blocknotificationnavigation").style.display="block";
		document.querySelector("#notificationnavigation").style.opacity="1";
		document.querySelector("#notificationnavigation").style.cursor="default";
		document.querySelector("#parametrenavigation").style.opacity="0.1";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="block";
		document.querySelector("#blockactualitepagenoir").style.display="block";
		document.querySelector("#blockabonnementpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
}

document.querySelector("#parametrenavigation").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockparametrenavigation')).display=='none')
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="block";
		document.querySelector("#parametrenavigation").style.opacity="1";
		document.querySelector("#parametrenavigation").style.cursor="default";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="block";
		document.querySelector("#blockactualitepagenoir").style.display="block";
		document.querySelector("#blockabonnementpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	else
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#pseudonavigation").style.opacity="0.1";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#actualitenavigation").style.opacity="0.1";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#abonnementnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.opacity="0.1";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#blockparametrenavigation").style.display="block";
		document.querySelector("#parametrenavigation").style.opacity="1";
		document.querySelector("#parametrenavigation").style.cursor="default";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="block";
		document.querySelector("#blockactualitepagenoir").style.display="block";
		document.querySelector("#blockabonnementpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
}

document.querySelector("#blockparametremodifierpseudo").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifierpseudo')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="35.5%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="35.5%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
}

document.querySelector("#modifierpseudo").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifierpseudo')).display=='none')
	{
		document.querySelector("#informationparametremodifierpseudo").style.display="none";
		document.querySelector("#critereparametremodifierpseudo").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifierpseudo").style.display="none";
		document.querySelector("#critereparametremodifierpseudo").style.display="block";
	}
}

document.querySelector("#blockparametremodifieremail").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifieremail')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="35.5%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="35.5%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
}

document.querySelector("#modifieremail").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifieremail')).display=='none')
	{
		document.querySelector("#informationparametremodifieremail").style.display="none";
		document.querySelector("#critereparametremodifieremail").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifieremail").style.display="none";
		document.querySelector("#critereparametremodifieremail").style.display="block";
	}
}

document.querySelector("#blockparametremodifierdatenaissance").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifierdatenaissance')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="35.5%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="35.5%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
}

document.querySelector("#modifierdatenaissance").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifierdatenaissance')).display=='none')
	{
		document.querySelector("#informationparametremodifierdatenaissance").style.display="none";
		document.querySelector("#critereparametremodifierdatenaissance").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifierdatenaissance").style.display="none";
		document.querySelector("#critereparametremodifierdatenaissance").style.display="block";
	}
}

document.querySelector("#blockparametremodifiergenre").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifiergenre')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="35.5%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="35.5%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
}

document.querySelector("#modifiergenre").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifiergenre')).display=='none')
	{
		document.querySelector("#informationparametremodifiergenre").style.display="none";
		document.querySelector("#critereparametremodifiergenre").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifiergenre").style.display="none";
		document.querySelector("#critereparametremodifiergenre").style.display="block";
	}
}

document.querySelector("#blockparametremodifieravatar").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifieravatar')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="35.5%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="35.5%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
}

document.querySelector("#modifieravatar").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifieravatar')).display=='none')
	{
		document.querySelector("#informationparametremodifieravatar").style.display="none";
		document.querySelector("#critereparametremodifieravatar").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifieravatar").style.display="none";
		document.querySelector("#critereparametremodifieravatar").style.display="block";
	}
}

// ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

// initialisation des variables
var fileInput  = document.querySelector( ".input-file" ),  
	button     = document.querySelector( ".input-file-trigger" ),
	the_return = document.querySelector(".file-return");

// action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
	if ( event.keyCode == 13 || event.keyCode == 32 ) {
		fileInput.focus();
	}
});

// action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
fileInput.focus();
return false;
});

// affiche un retour visuel dès que input:file change
fileInput.addEventListener( "change", function( event ) {  
	the_return.innerHTML = this.value;  
});

document.querySelector("#blockparametremodifierplandefond").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifierplandefond')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="35.5%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="35.5%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
	}
}

document.querySelector("#modifierplandefond").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifierplandefond')).display=='none')
	{
		document.querySelector("#informationparametremodifierplandefond").style.display="none";
		document.querySelector("#critereparametremodifierplandefond").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifierplandefond").style.display="none";
		document.querySelector("#critereparametremodifierplandefond").style.display="block";
	}
}

// ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

// initialisation des variables
var fileInput2  = document.querySelector( ".input-file2" ),  
	button2     = document.querySelector( ".input-file-trigger2" ),
	the_return2 = document.querySelector(".file-return2");

// action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
	if ( event.keyCode == 13 || event.keyCode == 32 ) {
		fileInput2.focus();
	}
});

// action lorsque le label est cliqué
button2.addEventListener( "click", function( event ) {
fileInput2.focus();
return false;
});

// affiche un retour visuel dès que input:file change
fileInput2.addEventListener( "change", function( event ) {  
	the_return2.innerHTML = this.value;  
});

document.querySelector("#blockparametremodifiermdp").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#contenueparametremodifiermdp')).right=='100%')
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="35.5%";
	}
	else
	{
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="35.5%";
	}
}

document.querySelector("#modifiermdp").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifiermdp')).display=='none')
	{
		document.querySelector("#informationparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiermdp").style.display="block";
		document.querySelector("#critereparametremodifiernewmdp").style.display="none";
		document.querySelector("#critereparametremodifierconfirmmdp").style.display="none";
	}
	else
	{
		document.querySelector("#informationparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiermdp").style.display="block";
		document.querySelector("#critereparametremodifiernewmdp").style.display="none";
		document.querySelector("#critereparametremodifierconfirmmdp").style.display="none";
	}
}

document.querySelector("#modifiernewmdp").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifiernewmdp')).display=='none')
	{
		document.querySelector("#informationparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiernewmdp").style.display="block";
		document.querySelector("#critereparametremodifierconfirmmdp").style.display="none";
	}
	else
	{
		document.querySelector("#informationparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiernewmdp").style.display="block";
		document.querySelector("#critereparametremodifierconfirmmdp").style.display="none";
	}
}

document.querySelector("#modifierconfirmmdp").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#critereparametremodifierconfirmmdp')).display=='none')
	{
		document.querySelector("#informationparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiernewmdp").style.display="none";
		document.querySelector("#critereparametremodifierconfirmmdp").style.display="block";
	}
	else
	{
		document.querySelector("#informationparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiermdp").style.display="none";
		document.querySelector("#critereparametremodifiernewmdp").style.display="none";
		document.querySelector("#critereparametremodifierconfirmmdp").style.display="block";
	}
}

document.querySelector("#deconnexionnavigation").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockdeconnexionnavigation')).display=='none')
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="block";
		document.querySelector("#deconnexionnavigation").style.opacity="1";
		document.querySelector("#deconnexionnavigation").style.cursor="default";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="block";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="block";
	}
	
	else
	{
		document.querySelector("#blockprofil").style.display="none";
		document.querySelector("#blockactualitenavigation").style.display="none";
		document.querySelector("#blockabonnementnavigation").style.display="none";
		document.querySelector("#blocknotificationnavigation").style.display="none";
		document.querySelector("#blockparametrenavigation").style.display="none";
		document.querySelector("#pseudonavigation").style.cursor="pointer";
		document.querySelector("#actualitenavigation").style.cursor="pointer";
		document.querySelector("#abonnementnavigation").style.cursor="pointer";
		document.querySelector("#notificationnavigation").style.cursor="pointer";
		document.querySelector("#parametrenavigation").style.cursor="pointer";
		document.querySelector("#contenueparametremodifierpseudo").style.right="100%";
		document.querySelector("#contenueparametremodifieremail").style.right="100%";
		document.querySelector("#contenueparametremodifierdatenaissance").style.right="100%";
		document.querySelector("#contenueparametremodifiergenre").style.right="100%";
		document.querySelector("#contenueparametremodifieravatar").style.right="100%";
		document.querySelector("#contenueparametremodifierplandefond").style.right="100%";
		document.querySelector("#contenueparametremodifiermdp").style.right="100%";
		document.querySelector("#blockdeconnexionnavigation").style.display="block";
		document.querySelector("#deconnexionnavigation").style.opacity="1";
		document.querySelector("#deconnexionnavigation").style.cursor="default";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="block";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="block";
	}
}

document.querySelector("#titreannuler").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockdeconnexionnavigation')).display=='block' & window.getComputedStyle(document.querySelector('#pseudonavigation')).opacity=='1')
	{
		document.querySelector("#blockprofil").style.display="block";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	
	else if (window.getComputedStyle(document.querySelector('#blockdeconnexionnavigation')).display=='block' & window.getComputedStyle(document.querySelector('#actualitenavigation')).opacity=='1')
	{
		document.querySelector("#blockactualitenavigation").style.display="block";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	
	else if (window.getComputedStyle(document.querySelector('#blockdeconnexionnavigation')).display=='block' & window.getComputedStyle(document.querySelector('#abonnementnavigation')).opacity=='1')
	{
		document.querySelector("#blockabonnementnavigation").style.display="block";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="none";
		document.querySelector("#blockactualitepagenoir").style.display="none";
		document.querySelector("#blockabonnementpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	
	else if (window.getComputedStyle(document.querySelector('#blockdeconnexionnavigation')).display=='block' & window.getComputedStyle(document.querySelector('#notificationnavigation')).opacity=='1')
	{
		document.querySelector("#blocknotificationnavigation").style.display="block";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="block";
		document.querySelector("#blockactualitepagenoir").style.display="block";
		document.querySelector("#blockabonnementpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
	
	else if (window.getComputedStyle(document.querySelector('#blockdeconnexionnavigation')).display=='block' & window.getComputedStyle(document.querySelector('#parametrenavigation')).opacity=='1')
	{
		document.querySelector("#blockparametrenavigation").style.display="block";
		document.querySelector("#blockdeconnexionnavigation").style.display="none";
		document.querySelector("#deconnexionnavigation").style.opacity="0.1";
		document.querySelector("#deconnexionnavigation").style.cursor="pointer";
		document.querySelector("#blockprofilpagenoir").style.display="block";
		document.querySelector("#blockactualitepagenoir").style.display="block";
		document.querySelector("#blockabonnementpagenoir").style.display="block";
		document.querySelector("#blockdeconnexionprofilpagenoir").style.display="none";
		document.querySelector("#blockdeconnexionactualitepagenoir").style.display="none";
		document.querySelector("#blockdeconnexionabonnementpagenoir").style.display="none";
	}
}

document.querySelector("#journalmenu").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockjournalmenu')).display=='none')
	{
		document.querySelector("#blockjournalmenu").style.display="block";
		document.querySelector("#journalmenu").style.cursor="default";
		document.querySelector("#barrejournalmenu").style.border="1.5px solid white";
		document.querySelector("#barrejournalmenu").style.background="white";
		document.querySelector("#blockimagesmenu").style.display="none";
		document.querySelector("#imagesmenu").style.cursor="pointer";
		document.querySelector("#barreimagesmenu").style.border="0px solid white";
		document.querySelector("#barreimagesmenu").style.background="none";
		document.querySelector("#blockhistoriquemenu").style.display="none";
		document.querySelector("#historiquemenu").style.cursor="pointer";
		document.querySelector("#barrehistoriquemenu").style.border="0px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="none";
		document.querySelector("#blockinformationsmenu").style.display="none";
		document.querySelector("#informationsmenu").style.cursor="pointer";
		document.querySelector("#barreinformationsmenu").style.border="0px solid white";
		document.querySelector("#barreinformationsmenu").style.background="none";
	}
	else
	{
		document.querySelector("#blockjournalmenu").style.display="block";
		document.querySelector("#journalmenu").style.cursor="default";
		document.querySelector("#barrejournalmenu").style.border="1.5px solid white";
		document.querySelector("#barrejournalmenu").style.background="white";
		document.querySelector("#blockimagesmenu").style.display="none";
		document.querySelector("#imagesmenu").style.cursor="pointer";
		document.querySelector("#barreimagesmenu").style.border="0px solid white";
		document.querySelector("#barreimagesmenu").style.background="none";
		document.querySelector("#blockhistoriquemenu").style.display="none";
		document.querySelector("#historiquemenu").style.cursor="pointer";
		document.querySelector("#barrehistoriquemenu").style.border="0px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="none";
		document.querySelector("#blockinformationsmenu").style.display="none";
		document.querySelector("#informationsmenu").style.cursor="pointer";
		document.querySelector("#barreinformationsmenu").style.border="0px solid white";
		document.querySelector("#barreinformationsmenu").style.background="none";
	}
}

document.querySelector("#imagesmenu").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockimagesmenu')).display=='none')
	{
		document.querySelector("#blockjournalmenu").style.display="none";
		document.querySelector("#journalmenu").style.cursor="pointer";
		document.querySelector("#barrejournalmenu").style.border="0px solid white";
		document.querySelector("#barrejournalmenu").style.background="none";
		document.querySelector("#blockimagesmenu").style.display="block";
		document.querySelector("#imagesmenu").style.cursor="default";
		document.querySelector("#barreimagesmenu").style.border="1.5px solid white";
		document.querySelector("#barreimagesmenu").style.background="white";
		document.querySelector("#blockhistoriquemenu").style.display="none";
		document.querySelector("#historiquemenu").style.cursor="pointer";
		document.querySelector("#barrehistoriquemenu").style.border="0px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="none";
		document.querySelector("#blockinformationsmenu").style.display="none";
		document.querySelector("#informationsmenu").style.cursor="pointer";
		document.querySelector("#barreinformationsmenu").style.border="0px solid white";
		document.querySelector("#barreinformationsmenu").style.background="none";
	}
	else
	{
		document.querySelector("#blockjournalmenu").style.display="none";
		document.querySelector("#journalmenu").style.cursor="pointer";
		document.querySelector("#barrejournalmenu").style.border="0px solid white";
		document.querySelector("#barrejournalmenu").style.background="none";
		document.querySelector("#blockimagesmenu").style.display="block";
		document.querySelector("#imagesmenu").style.cursor="default";
		document.querySelector("#barreimagesmenu").style.border="1.5px solid white";
		document.querySelector("#barreimagesmenu").style.background="white";
		document.querySelector("#blockhistoriquemenu").style.display="none";
		document.querySelector("#historiquemenu").style.cursor="pointer";
		document.querySelector("#barrehistoriquemenu").style.border="0px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="none";
		document.querySelector("#blockinformationsmenu").style.display="none";
		document.querySelector("#informationsmenu").style.cursor="pointer";
		document.querySelector("#barreinformationsmenu").style.border="0px solid white";
		document.querySelector("#barreinformationsmenu").style.background="none";
	}
}

document.querySelector("#historiquemenu").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockhistoriquemenu')).display=='none')
	{
		document.querySelector("#blockjournalmenu").style.display="none";
		document.querySelector("#journalmenu").style.cursor="pointer";
		document.querySelector("#barrejournalmenu").style.border="0px solid white";
		document.querySelector("#barrejournalmenu").style.background="none";
		document.querySelector("#blockimagesmenu").style.display="none";
		document.querySelector("#imagesmenu").style.cursor="pointer";
		document.querySelector("#barreimagesmenu").style.border="0px solid white";
		document.querySelector("#barreimagesmenu").style.background="none";
		document.querySelector("#blockhistoriquemenu").style.display="block";
		document.querySelector("#historiquemenu").style.cursor="default";
		document.querySelector("#barrehistoriquemenu").style.border="1.5px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="white";
		document.querySelector("#blockinformationsmenu").style.display="none";
		document.querySelector("#informationsmenu").style.cursor="pointer";
		document.querySelector("#barreinformationsmenu").style.border="0px solid white";
		document.querySelector("#barreinformationsmenu").style.background="none";
	}
	else
	{
		document.querySelector("#blockjournalmenu").style.display="none";
		document.querySelector("#journalmenu").style.cursor="pointer";
		document.querySelector("#barrejournalmenu").style.border="0px solid white";
		document.querySelector("#barrejournalmenu").style.background="none";
		document.querySelector("#blockimagesmenu").style.display="none";
		document.querySelector("#imagesmenu").style.cursor="pointer";
		document.querySelector("#barreimagesmenu").style.border="0px solid white";
		document.querySelector("#barreimagesmenu").style.background="none";
		document.querySelector("#blockhistoriquemenu").style.display="block";
		document.querySelector("#historiquemenu").style.cursor="default";
		document.querySelector("#barrehistoriquemenu").style.border="1.5px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="white";
		document.querySelector("#blockinformationsmenu").style.display="none";
		document.querySelector("#informationsmenu").style.cursor="pointer";
		document.querySelector("#barreinformationsmenu").style.border="0px solid white";
		document.querySelector("#barreinformationsmenu").style.background="none";
	}
}

document.querySelector("#informationsmenu").onclick = function() 
{ 
	if (window.getComputedStyle(document.querySelector('#blockinformationsmenu')).display=='none')
	{
		document.querySelector("#blockjournalmenu").style.display="none";
		document.querySelector("#journalmenu").style.cursor="pointer";
		document.querySelector("#barrejournalmenu").style.border="0px solid white";
		document.querySelector("#barrejournalmenu").style.background="none";
		document.querySelector("#blockimagesmenu").style.display="none";
		document.querySelector("#imagesmenu").style.cursor="pointer";
		document.querySelector("#barreimagesmenu").style.border="0px solid white";
		document.querySelector("#barreimagesmenu").style.background="none";
		document.querySelector("#blockhistoriquemenu").style.display="none";
		document.querySelector("#historiquemenu").style.cursor="pointer";
		document.querySelector("#barrehistoriquemenu").style.border="0px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="none";
		document.querySelector("#blockinformationsmenu").style.display="block";
		document.querySelector("#informationsmenu").style.cursor="default";
		document.querySelector("#barreinformationsmenu").style.border="1.5px solid white";
		document.querySelector("#barreinformationsmenu").style.background="white";
	}
	else
	{
		document.querySelector("#blockjournalmenu").style.display="none";
		document.querySelector("#journalmenu").style.cursor="pointer";
		document.querySelector("#barrejournalmenu").style.border="0px solid white";
		document.querySelector("#barrejournalmenu").style.background="none";
		document.querySelector("#blockimagesmenu").style.display="none";
		document.querySelector("#imagesmenu").style.cursor="pointer";
		document.querySelector("#barreimagesmenu").style.border="0px solid white";
		document.querySelector("#barreimagesmenu").style.background="none";
		document.querySelector("#blockhistoriquemenu").style.display="none";
		document.querySelector("#historiquemenu").style.cursor="pointer";
		document.querySelector("#barrehistoriquemenu").style.border="0px solid white";
		document.querySelector("#barrehistoriquemenu").style.background="none";
		document.querySelector("#blockinformationsmenu").style.display="block";
		document.querySelector("#informationsmenu").style.cursor="default";
		document.querySelector("#barreinformationsmenu").style.border="1.5px solid white";
		document.querySelector("#barreinformationsmenu").style.background="white";
	}
}
