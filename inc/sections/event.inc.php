<?php
$dataEvent=execute("SELECT * FROM event
INNER JOIN event_content
ON event_content.id_event=event.id_event
INNER JOIN content
ON content.id_content=event_content.id_content
INNER JOIN page
ON page.id_page=content.id_page
INNER JOIN media
ON page.id_page=media.id_page
ORDER BY end_date_event DESC LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
?>
<section id="event" class="fontImgEvent">
  <h2>L'event</h2>
  <article>
  <?php
      foreach ($dataEvent as $event):
  ?>
    <figure><img alt="event" src="assets/img/<?= $event['name_media'];?>"></figure>
    <div>
      <h3>Time reaming<h3>
      <div id="timerJs"></div>

      <h3><?= $event['title_content']; ?></h3>
      <p><?= $event['description_content']; ?></p>
    </div>
  <?php
      endforeach;
  ?>
  </article>
</section>