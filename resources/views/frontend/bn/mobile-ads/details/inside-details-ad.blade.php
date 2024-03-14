<script>
    let description = document.querySelector('.news-details .description');
    let descriptionParas = description.querySelectorAll('p');

    let insertImageAd = (href, src, width) => {
        let div = document.createElement('div');
        div.className = 'advertisement marginTop10 marginBottom10';

        let anchor = document.createElement('a');

        let img = document.createElement('img');
        img.style.maxWidth = width + 'px';
        img.src = src;

        anchor.href = href;
        anchor.target = "_blank";
        anchor.rel = "nofollow";

        anchor.append(img);
        div.append(anchor);

        return div;
    };

    let insertDfpCodeAd = (code) => {
        let div = document.createElement('div');
        div.className = 'marginTop10 marginBottom10';
        div.innerHTML = code;

        return div;
    };

    // Position 2 = Inside Details One, 3 = Inside Details Two, 4 = Inside Details Three
    let insideDetailsOneAd = @json(Cache::get('detailsPageAdsCacheKey')->where('position', 2)->first());
    let insideDetailsTwoAd = @json(Cache::get('detailsPageAdsCacheKey')->where('position', 3)->first());
    let insideDetailsThreeAd = @json(Cache::get('detailsPageAdsCacheKey')->where('position', 4)->first());
    let adImgPath = '{{ asset(config('appconfig.adPath')) }}/';

    // Type 1=DFP, 2=Code, 3=Image
    if (descriptionParas.length > 2 && insideDetailsOneAd != null) {
        if (insideDetailsOneAd.type == 3) {
            descriptionParas[0].parentNode.insertBefore(insertImageAd(insideDetailsOneAd.external_link, (adImgPath + insideDetailsOneAd.desktop_image_path), 300), descriptionParas[1].nextSibling);
        } else {
            descriptionParas[0].parentNode.insertBefore(insertDfpCodeAd(insideDetailsOneAd.code), descriptionParas[1].nextSibling);
        }
    }

    if (descriptionParas.length > 4 && insideDetailsTwoAd != null) {
        if (insideDetailsTwoAd.type == 3) {
            descriptionParas[0].parentNode.insertBefore(insertImageAd(insideDetailsTwoAd.external_link, (adImgPath + insideDetailsTwoAd.desktop_image_path), 300), descriptionParas[3].nextSibling);
        } else {
            descriptionParas[0].parentNode.insertBefore(insertDfpCodeAd(insideDetailsTwoAd.code), descriptionParas[3].nextSibling);
        }
    }

    if (descriptionParas.length > 6 && insideDetailsThreeAd != null) {
        if (insideDetailsThreeAd.type == 3) {
            descriptionParas[0].parentNode.insertBefore(insertImageAd(insideDetailsThreeAd.external_link, (adImgPath + insideDetailsThreeAd.desktop_image_path), 300), descriptionParas[5].nextSibling);
        } else {
            descriptionParas[0].parentNode.insertBefore(insertDfpCodeAd(insideDetailsThreeAd.code), descriptionParas[5].nextSibling);
        }
    }
</script>
