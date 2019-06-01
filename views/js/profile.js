let main = document.getElementsByClassName('main_info')[0];
if (main && window.outerWidth < 1640)
    main.style.display = 'none';
window.onresize = () => {
    if (main) {
        if (window.outerWidth < 1640)
            main.style.display = 'none';
        else
            if (main.style.display === 'none')
                main.style.display = 'block';
    }
};

//if (document.documentURI === 'http://localhost/user/profile') //for home
if (document.documentURI === 'http://localhost:8080/user/profile') { //for unit
    let parent = document.getElementsByClassName('posts_profile')[0];
    ajaxProfileFeed(parent,0);
    window.onscroll = () => {
        let scrollHeight, clientHeight, position, elements;
        scrollHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );
        clientHeight = document.documentElement.clientHeight + 40;
        position = scrollHeight - window.pageYOffset - clientHeight;
        if (position < 0) {
            elements = parent.getElementsByClassName('post_container').length;
            setTimeout(() =>
                ajaxProfileFeed(parent, elements),500);
        }
    }
}

function ajaxProfileFeed(parent, elements) {
    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'profile/getmyfiveposts', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send('elements='+elements);

    ajax.onreadystatechange = function () {
        if (ajax.status !== 200) {
            location.href = 'error';
        }
        if (ajax.readyState === 4) {
            let result = JSON.parse(ajax.responseText);
            //let result = ajax.responseText;
            // console.log(result);
            if (result.length > 0)
                addFivePosts(parent, result);
            else {
                let empty = document.createElement('p');
                empty.style.fontWeight = 'bold';
                empty.style.color = 'darkred';
                empty.innerHTML = "You don't have any posts yet!";
                parent.append(empty);
            }
        }
    };
}

function addFivePosts(parent, result) {
    let container, photo, description,
        activity, counter, likes, comments;

    for (let i = 0; i < result.length; i++) {
        container = document.createElement('div');
        container.id = String(i);
        container.className = 'post_container';

        //append photo
        photo = document.createElement('img');
        photo.className = 'post_photo';
        photo.src = result[i]['path'];
        container.append(photo);

        //append description
        description = document.createElement('div');
        description.className = 'post_description';
        description.innerHTML += result[i]['description'];
        container.append(description);

        //append activity - likes
        activity = document.createElement('div');
        activity.className = 'activity_box';
        likes = document.createElement('img');
        likes.src = 'views/pictures/service/like.png';
        likes.style.width = '30px';
        likes.setAttribute('alt', 'likes');
        likes.setAttribute('title', 'likes');
        likes.className = 'activity';
        counter = document.createElement('p');
        counter.innerHTML = result[i]['likes'];
        counter.style.paddingTop = '6px';
        activity.append(likes);
        activity.append(counter);
        container.append(activity);

        //append activity - comments
        activity = document.createElement('div');
        activity.className = 'activity_box';
        comments = document.createElement('img');
        comments.src = 'views/pictures/service/comment.png';
        comments.style.width = '30px';
        comments.setAttribute('alt', 'comments');
        comments.setAttribute('title', 'comments');
        comments.className = 'activity';
        counter = document.createElement('p');
        counter.innerHTML = result[i]['comments'];
        counter.style.paddingTop = '6px';
        activity.append(comments);
        activity.append(counter);
        container.append(activity);

        //append all this stuff to container
        parent.append(container);
    }
}