<?php

function getContent($link = 'https://vnexpress.net/rss/the-gioi.rss',$totalItems = 12)
{

    $data = file_get_contents($link);
    $xml = new SimpleXMLElement($data);
    $xhtml = '';
    $i = 0;
    foreach ($xml->channel->item as $item) {
        if ($i == $totalItems) break;
        $title = $item->title;
        $link  = $item->link;
        $time  = $item->pubDate;
        preg_match_all('#.*src="(.*)".*br>(.*)<end>#imsU', $item->description . "<end>", $matches);
        $image       = @$matches[1][0];
        $description = @$matches[2][0];
        $xhtml .= '
        <div class="col-md-6 col-lg-4 p-3">
            <div id="dynamicForm" class="entry mb-1 clearfix">
                <div class="entry-image mb-3">
                    <a href="' . $image . '"
                        data-lightbox="image"
                        style="background: url(' . $image . ') no-repeat center center; background-size: cover; height: 278px;"></a>
                </div>
                <div class="entry-title">
                    <h3><a href="' . $link . '"
                            target="_blank">' . $title . '</a>
                    </h3>
                </div>
                <div class="entry-content">' . $description . '</div>
                <div class="entry-meta no-separator nohover">
                    <ul class="justify-content-between mx-0">
                        <li><i class="icon-calendar2"></i>' . $time . '</li>
                        <li>vnexpress.net</li>
                    </ul>
                </div>
                <div class="entry-meta no-separator hover">
                    <ul class="mx-0">
                        <li><a href="' . $link . '"
                                target="_blank">Xem &rarr;</a></li>
                    </ul>
                </div>
            </div>
        </div>                                                   
        ';
        $i++;
    }

    return $xhtml;
}
