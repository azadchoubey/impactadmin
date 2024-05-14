### Get languages from picklist

`select distinct(picklist.name) as Name,picklist.id as ID
from picklist join pub_master on pub_master.language = picklist.id
where picklist.id NOT IN
(select tagId from (select tagId from media_universe where clientId='" . $clientid . "' and type='Language')
as t)
order by name`


### Get languages from media_universe

`select distinct(picklist.name) as Name,picklist.id as ID from picklist join media_universe as mucp on mucp.tagId = picklist.id where mucp.type='Language' and mucp.clientId ='A0010' order by name`

### Get edition from picklist

`select distinct(picklist.name) as Name,picklist.id as ID from picklist join pub_master on pub_master.place = picklist.id where pub_master.place NOT IN 
       (select tagId from (select tagId from media_universe where clientId='" . $clientid . "' and type='Edition')
as t) order by name`


### Get edition from media_universe

`select distinct(picklist.name) as Name,picklist.id as ID from picklist join media_universe as mucp on mucp.tagId = picklist.id where mucp.type='Edition' and mucp.clientId ='" . $clientid . "' order by name`

### Get newspapers from picklist

`SELECT pub_master.Title as title,pub_master.PubId as pubid,picklist.Name as ediPlace from pub_master join picklist on pub_master.Place=picklist.ID where pub_master.Type = 230 and PrimaryPubID = 0 and pubid NOT IN (select pubid from (SELECT mum.pubid as pubid
FROM media_universe_master as mum
join pub_master as pm on mum.pubid=pm.PubId
where clientid='".$clientid."' AND pm.Type = 230 AND pm.PrimaryPubID = 0 AND pm.deleted =0) as t) and deleted =0 order by title`

### Get newspapers from media_universe

`SELECT mum.pubid as pubid, pm.Title as title,pl.Name as ediPlace
FROM media_universe_master as mum
join pub_master as pm on mum.pubid=pm.PubId
join picklist as pl on pm.Place=pl.ID
where clientid='".$clientid."' AND pm.Type = 230 AND pm.PrimaryPubID = 0 AND pm.deleted =0 order by title`

### Get magazine from picklist

`SELECT pub_master.Title as title,pub_master.PubId as pubid,picklist.Name as ediPlace from pub_master join picklist on pub_master.Place=picklist.ID where pub_master.Type = 229 and pub_master.PrimaryPubID = 0 and pub_master.deleted =0 and pub_master.pubid NOT IN (select pubid from (SELECT mum.pubid as pubid
FROM media_universe_master as mum
join pub_master as pm on mum.pubid=pm.PubId
where clientid='".$clientid."' AND pm.Type = 229 AND pm.PrimaryPubID = 0 AND pm.deleted =0) as t)  and deleted =0 order by title`

### Get magazine from media_universe

`SELECT mum.pubid as pubid, pm.Title as title,pl.Name as ediPlace
FROM media_universe_master as mum
join pub_master as pm on mum.pubid=pm.PubId
join picklist as pl on pm.Place=pl.ID
where clientid='".$clientid."' AND pm.Type = 229 AND pm.PrimaryPubID = 0 AND pm.deleted =0 order by title`

### Get newspaper category from picklist

`SELECT distinct(picklist.Name) as Category,picklist.ID as catid FROM pub_master left join picklist on pub_master.Category=picklist.ID
where pub_master.primaryPubId=0 and pub_master.Type=230 and picklist.Name!=''
and pub_master.Category NOT IN (select tagId from (select tagId from media_universe where clientId='" . $clientid . "' and type='Newspaper' and tag='B') as t) order by picklist.Name`

### Get newspaper category from media_universe

`SELECT distinct(picklist.Name) as Category,picklist.ID as catid FROM media_universe as mucp left join picklist on mucp.tagid=picklist.ID left join pub_master on picklist.ID=pub_master.Category where pub_master.primaryPubId=0 and pub_master.Type=230 and mucp.type='Newspaper' and mucp.tag='B' and mucp.clientId ='" . $clientid . "' AND picklist.ID IS NOT NULL order by Category`

### Get magazine category from picklist

`SELECT distinct(picklist.Name) as Category,picklist.ID as catid FROM pub_master left join picklist on pub_master.Category=picklist.ID
where pub_master.primaryPubId=0 and pub_master.Type=229 and picklist.Name!=''
and pub_master.Category NOT IN (select tagId from (select tagId from media_universe where clientId='" . $clientid . "' and type='Magazine' and tag='B') as t) order by picklist.Name`

### Get magazine category from media_universe

`SELECT distinct(picklist.Name) as Category,picklist.ID as catid FROM media_universe as mucp left join picklist on mucp.tagid=picklist.ID left join pub_master on picklist.ID=pub_master.Category where pub_master.primaryPubId=0 and pub_master.Type=229 and mucp.type='Magazine' and mucp.tag='B' and mucp.clientId ='" . $clientid . "' AND picklist.ID IS NOT NULL order by Category`


### After clicking save button the edition data in media_universe

```
switch ($editionsArr[$i]) {
                case "-1":
                    $tag = 'A';
                    break;
                case "-6":
                    $tag = '6P';
                    break;
                case "-8":
                    $tag = '8P';
                    break;
                default :
                    $tag = 'P';
                     }
                     
```

`insert into media_universe (clientId, type, tag, tagId) values ('" . $clientId . "','Edition','" . $tag . "','" . $editionsArr[$i] . "')`

```
if($tag =='8P'){
 $ins8PCityIds = "insert into media_universe (clientId, type, tag, tagId) VALUES 
                        ('" . $clientId . "','Edition','P','1'), 
                        ('" . $clientId . "','Edition','P','232'),
                        ('" . $clientId . "','Edition','P','233'),
                        ('" . $clientId . "','Edition','P','156'),
                        ('" . $clientId . "','Edition','P','450'),
                        ('" . $clientId . "','Edition','P','157'),
                        ('" . $clientId . "','Edition','P','531'),
                        ('" . $clientId . "','Edition','P','206')";
                    mysql_query($ins8PCityIds, $dbCon4) or die(mail($to, $subject, "Error: (".mysql_error().")", $headers));
            }else if($tag =='6P'){
                     $ins6PCityIds = "insert into media_universe (clientId, type, tag, tagId) VALUES 
                        ('" . $clientId . "','Edition','P','1'), 
                        ('" . $clientId . "','Edition','P','232'),
                        ('" . $clientId . "','Edition','P','233'),
                        ('" . $clientId . "','Edition','P','156'),
                        ('" . $clientId . "','Edition','P','450'),
                        ('" . $clientId . "','Edition','P','157')";
                    mysql_query($ins6PCityIds, $dbCon4) or die(mail($to, $subject, "Error: (".mysql_error().")", $headers));
            }
```




