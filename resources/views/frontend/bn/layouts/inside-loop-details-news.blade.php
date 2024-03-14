


<script>
    let insideMoreNewsArrayPost = @json($postInsideContent);

    for(let i = 0; i < insideMoreNewsArrayPost.length; i++){
        let desc = document.getElementsByClassName('loopDescription'+i);
        // for(let i = 0; i< desc.length; i++){

        let insideMoreNews = insideMoreNewsArrayPost[i];

        let descParas = desc[0].querySelectorAll('p');

        let insertRelatedNews = (title, src, href) => {

            let relatedNews = document.createElement(`div`);
            relatedNews.className = `inside-news marginTop20 marginBottom20`;

            let h5 = document.createElement(`h5`);
            h5.style.fontSize = `16px`;
            h5.style.fontWeight = `bold`;
            h5.innerText = `আরও পড়ুন`;
            relatedNews.append(h5);

            let containerFluid = document.createElement(`div`);
            containerFluid.className = `container-fluid`;
            containerFluid.style.border = `2px solid grey`;
            relatedNews.append(containerFluid);

            let link = document.createElement(`a`);
            link.href = href;
            containerFluid.append(link);

            let headline = document.createElement(`div`);
            headline.className = `headline marginTop10 marginBottom10`;
            headline.style.cssText = `font-size:19px;font-weight: bold; width: 65%; float: left`;
            headline.innerText = title;
            link.append(headline);

            let img = document.createElement(`img`);
            img.className = `marginTop10 marginBottom10`;
            img.style.cssText = `width: 85px;float: right`;
            img.src = src;
            img.title = title;
            img.alt = title;
            link.append(img);

            return relatedNews;
        }

        let googleNews = () => {
            let link = document.createElement(`a`);
            link.className = `text-center marginTop10 marginBottom10`;
            link.style.cssText =`text-decoration:none; display:flex; justify-content:center`;
            link.href = `https://news.google.com/publications/CAAqBwgKMNq9sgsw59jJAw?ceid=BD:bn&oc=3&hl=bn&gl=BD`;
            link.target = `_blank`;

            let img = document.createElement(`img`);
            img.src = `https://cdn-icons-png.flaticon.com/512/2702/2702605.png`;
            img.style.cssText = `width: 25px; margin-right: 8px`;

            let h4 = document.createElement(`h4`);
            h4.style.cssText = `font-weight: bold`;
            h4.innerText = `সর্বশেষ খবর পেতে ঢাকা প্রকাশের গুগল নিউজ চ্যানেলটি সাবস্ক্রাইব করুন ।`;
            link.append(img);
            link.append(h4);

            return link;
        }

        let itemIncrement = 0;
        descParas.forEach((item, i) => {

            if (i > 0 && i % 3 === 0 && insideMoreNews[itemIncrement]) {
                descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[itemIncrement].content_heading, fJsNewsImgPath(insideMoreNews[itemIncrement].img_xs_path), fJsNewsURL(insideMoreNews[itemIncrement].content_id, insideMoreNews[itemIncrement].category.cat_slug, insideMoreNews[itemIncrement].subcategory?.subcat_slug)), descParas[i-1].nextSibling);

                itemIncrement++;
            }
        })

        // if (descParas.length > 3 && insideMoreNews[0]) {
        //     descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[0].content_heading, fJsNewsImgPath(insideMoreNews[0].img_xs_path), fJsNewsURL(insideMoreNews[0].content_id, insideMoreNews[0].category.cat_slug, insideMoreNews[0].subcategory?.subcat_slug)), descParas[2].nextSibling);
        // }
        //
        // if (descParas.length > 5 && insideMoreNews[1]) {
        //     descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[1].content_heading, fJsNewsImgPath(insideMoreNews[1].img_xs_path), fJsNewsURL(insideMoreNews[1].content_id, insideMoreNews[1].category.cat_slug, insideMoreNews[1].subcategory?.subcat_slug)), descParas[4].nextSibling);
        // }
        //
        // if (descParas.length > 7 && insideMoreNews[2]) {
        //     descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[2].content_heading, fJsNewsImgPath(insideMoreNews[2].img_xs_path), fJsNewsURL(insideMoreNews[2].content_id, insideMoreNews[2].category.cat_slug, insideMoreNews[2].subcategory?.subcat_slug)), descParas[6].nextSibling);
        // }

        if (descParas.length > 1) {
            descParas[0].parentNode.insertBefore(googleNews(), descParas[0].nextSibling);
        }

        function fJsNewsURL(content_id, cat_slug, subcat_slug='') {
            return location.origin+'/'+cat_slug+'/news/'+content_id;
            // return location.origin+'/'+cat_slug+(subcat_slug ? subcat_slug : '')+'/news/'+content_id;
        }

        function fJsNewsImgPath(img_path) {
            return location.origin+'/media/content/images/'+img_path;
        }

        // } // End Foreach
    }


</script>










<!-- Main Script ----->
{{--<script>--}}
{{--    let insideMoreNews = @json($insideMoreNews);--}}

{{--    let desc = document.querySelector('.news-details .description');--}}
{{--    let descParas = desc.querySelectorAll('p');--}}

{{--    let insertRelatedNews = (title, src, href) => {--}}

{{--        let relatedNews = document.createElement(`div`);--}}
{{--        relatedNews.className = `inside-news marginTop20 marginBottom20`;--}}

{{--        let h5 = document.createElement(`h5`);--}}
{{--        h5.style.fontSize = `16px`;--}}
{{--        h5.style.fontWeight = `bold`;--}}
{{--        h5.innerText = `আরও পড়ুন`;--}}
{{--        relatedNews.append(h5);--}}

{{--        let containerFluid = document.createElement(`div`);--}}
{{--        containerFluid.className = `container-fluid`;--}}
{{--        containerFluid.style.border = `2px solid grey`;--}}
{{--        relatedNews.append(containerFluid);--}}

{{--        let link = document.createElement(`a`);--}}
{{--        link.href = href;--}}
{{--        containerFluid.append(link);--}}

{{--        let headline = document.createElement(`div`);--}}
{{--        headline.className = `headline marginTop10 marginBottom10`;--}}
{{--        headline.style.cssText = `font-size:19px;font-weight: bold; width: 65%; float: left`;--}}
{{--        headline.innerText = title;--}}
{{--        link.append(headline);--}}

{{--        let img = document.createElement(`img`);--}}
{{--        img.className = `marginTop10 marginBottom10`;--}}
{{--        img.style.cssText = `width: 85px;float: right`;--}}
{{--        img.src = src;--}}
{{--        img.title = title;--}}
{{--        img.alt = title;--}}
{{--        link.append(img);--}}

{{--        return relatedNews;--}}
{{--    }--}}

{{--    let googleNews = () => {--}}
{{--        let link = document.createElement(`a`);--}}
{{--        link.className = `text-center marginTop10 marginBottom10`;--}}
{{--        link.style.cssText =`text-decoration:none; display:flex; justify-content:center`;--}}
{{--        link.href = `https://news.google.com/publications/CAAqBwgKMNq9sgsw59jJAw?ceid=BD:bn&oc=3&hl=bn&gl=BD`;--}}
{{--        link.target = `_blank`;--}}

{{--        let img = document.createElement(`img`);--}}
{{--        img.src = `https://cdn-icons-png.flaticon.com/512/2702/2702605.png`;--}}
{{--        img.style.cssText = `width: 25px; margin-right: 8px`;--}}


{{--        let h4 = document.createElement(`h4`);--}}
{{--        h4.style.cssText = `font-weight: bold`;--}}
{{--        h4.innerText = `সর্বশেষ খবর পেতে ঢাকা প্রকাশের গুগল নিউজ চ্যানেলটি সাবস্ক্রাইব করুন ।`;--}}
{{--        link.append(img);--}}
{{--        link.append(h4);--}}

{{--        return link;--}}
{{--    }--}}

{{--    let itemIncrement = 0;--}}
{{--    descParas.forEach((item, i) => {--}}

{{--        if (i > 0 && i % 3 === 0 && insideMoreNews[itemIncrement]) {--}}
{{--            descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[itemIncrement].content_heading, fJsNewsImgPath(insideMoreNews[itemIncrement].img_xs_path), fJsNewsURL(insideMoreNews[itemIncrement].content_id, insideMoreNews[itemIncrement].category.cat_slug, insideMoreNews[itemIncrement].subcategory?.subcat_slug)), descParas[i-1].nextSibling);--}}

{{--            itemIncrement++;--}}
{{--        }--}}
{{--    })--}}

{{--    // if (descParas.length > 3 && insideMoreNews[0]) {--}}
{{--    //     descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[0].content_heading, fJsNewsImgPath(insideMoreNews[0].img_xs_path), fJsNewsURL(insideMoreNews[0].content_id, insideMoreNews[0].category.cat_slug, insideMoreNews[0].subcategory?.subcat_slug)), descParas[2].nextSibling);--}}
{{--    // }--}}
{{--    //--}}
{{--    // if (descParas.length > 5 && insideMoreNews[1]) {--}}
{{--    //     descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[1].content_heading, fJsNewsImgPath(insideMoreNews[1].img_xs_path), fJsNewsURL(insideMoreNews[1].content_id, insideMoreNews[1].category.cat_slug, insideMoreNews[1].subcategory?.subcat_slug)), descParas[4].nextSibling);--}}
{{--    // }--}}
{{--    //--}}
{{--    // if (descParas.length > 7 && insideMoreNews[2]) {--}}
{{--    //     descParas[0].parentNode.insertBefore(insertRelatedNews(insideMoreNews[2].content_heading, fJsNewsImgPath(insideMoreNews[2].img_xs_path), fJsNewsURL(insideMoreNews[2].content_id, insideMoreNews[2].category.cat_slug, insideMoreNews[2].subcategory?.subcat_slug)), descParas[6].nextSibling);--}}
{{--    // }--}}

{{--    if (descParas.length > 1) {--}}
{{--        descParas[0].parentNode.insertBefore(googleNews(), descParas[0].nextSibling);--}}
{{--    }--}}

{{--    function fJsNewsURL(content_id, cat_slug, subcat_slug='') {--}}
{{--        return location.origin+'/'+cat_slug+(subcat_slug ? subcat_slug : '')+'/news/'+content_id;--}}
{{--    }--}}

{{--    function fJsNewsImgPath(img_path) {--}}
{{--        return location.origin+'/media/content/images/'+img_path;--}}
{{--    }--}}
{{--</script>--}}
