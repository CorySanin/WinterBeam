<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include $root . "/includes/include.php";

$member = $useriface->getuser($_GET['user']);

echo '<?xml version="1.0" encoding="utf-8"?>';

if(isset($_GET['user']) && $_GET['user'] != '')
{
?>
<!--<?php echo $_GET['user']; ?>-->
<a:entry xmlns:a="http://www.w3.org/2005/Atom" xmlns="http://schemas.zune.net/profiles/2008/01">
  <a:link rel="self" type="application/atom+xml" href="http://socialapi.zune.net/en-US/members/CoryRS"/>
  <a:updated><?php echo $member['updated']; ?></a:updated>
  <a:title type="text"><?php echo $member['zuneTag']; ?></a:title>
  <a:content type="html"/>
  <a:author>
    <a:name><?php echo $member['zuneTag']; ?></a:name>
    <a:uri><?php echo $config->domainWiProtocolAndSub('api.') . '/en-US/members/' . $member['zuneTag']; ?></a:uri>
  </a:author>
  <a:id>urn:uuid:<?php echo $member['zuneTag']; ?></a:id>
  <a:link rel="related" type="application/atom+xml" href="<?php echo $config->domainWiProtocolAndSub('api.') . '/en-US/members/' . $member['zuneTag']; ?>/friends" title="friends"/>
  <playcount><?php echo $member['playcount']; ?></playcount>
  <zunetag><?php echo $member['zuneTag']; ?></zunetag>
  <displayname><?php echo $member['name']; ?></displayname>
  <status><?php echo $member['status']; ?></status>
  <bio><?php echo $member['bio']; ?></bio>
  <location><?php echo $member['location']; ?></location>
  <images>
    <link rel="enclosure" href="http://cache-tiles.zune.net/tiles/user/<?php echo $member['zuneTag']; ?>" title="usertile"/>
    <link rel="enclosure" href="http://cache-tiles.zune.net/tiles/background/<?php echo $member['zuneTag']; ?>" title="background"/>
  </images>
  <playlists>
    <link rel="related" href="http://socialapi.zune.net/en-US/members/<?php echo $member['zuneTag']; ?>/playlists/BuiltIn-RecentTracks" title="BuiltIn-RecentTracks" updated="2011-11-18T06:46:40Z"/>
    <link rel="related" href="http://socialapi.zune.net/en-US/members/<?php echo $member['zuneTag']; ?>/playlists/BuiltIn-MostPlayedArtists" title="BuiltIn-MostPlayedArtists" updated="2011-11-18T06:46:40Z"/>
    <link rel="related" href="http://socialapi.zune.net/en-US/members/<?php echo $member['zuneTag']; ?>/playlists/BuiltIn-FavoriteTracks" title="BuiltIn-FavoriteTracks" updated="2011-11-23T05:11:34.1795165Z"/>
  </playlists>
</a:entry>

<?php
}
?>