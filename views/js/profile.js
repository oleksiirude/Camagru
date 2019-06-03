let main = document.getElementsByClassName('main_info')[0];
if (main && window.outerWidth < 1640)
    main.style.display = 'none';

let avatar_profile = document.getElementsByClassName('avatar_profile')[0];
if (avatar_profile)
    avatar_profile.addEventListener('click', function () {
        window.scrollTo(0, 0);
    });
window.onresize = () => {
    if (main) {
        if (window.outerWidth < 1640)
            main.style.display = 'none';
        else
            if (main.style.display === 'none')
                main.style.display = 'block';
    }
};

if (document.documentURI === 'http://localhost/user/profile') { //for home
//if (document.documentURI === 'http://localhost:8080/user/profile') { //for unit
    window.scrollTo(0, 0);
    let parent = document.getElementsByClassName('posts_profile')[0];
    ajaxProfileFeed(parent,0);
    window.onscroll = () => {
        let scrollHeight, clientHeight, position, elements;
        scrollHeight = Math.max(
            document.body.scrollHeight, document.documentElement.scrollHeight,
            document.body.offsetHeight, document.documentElement.offsetHeight,
            document.body.clientHeight, document.documentElement.clientHeight
        );
        clientHeight = document.documentElement.clientHeight;
        position = scrollHeight - window.pageYOffset - clientHeight;
        if (position === 0) {
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

    ajax.onreadystatechange = () => {
        if (ajax.status !== 200) {
            location.href = 'error';
        }
        if (ajax.readyState === 4) {
            let result = JSON.parse(ajax.responseText);
            //let result = ajax.responseText;
            //console.log(result);
            if (result.length > 0)
                addContent(parent, result);
            else if (result['empty'] === true) {
                let empty = document.getElementById('empty');
                if (empty)
                    empty.remove();
                empty = document.createElement('p');
                empty.id = 'empty';
                empty.style.fontWeight = 'bold';
                empty.style.color = 'darkred';
                empty.innerHTML = "You don't have any posts yet!";
                parent.append(empty);
            }
        }
    };
}

function addContent(parent, result) {
    let container, photo, description,
        activity, counter, likes, comments;

    for (let i = 0; i < result.length; i++) {
        container = document.createElement('div');
        container.className = 'post_container';

        //append photo
        photo = document.createElement('img');
        photo.id = 'img'+result[i]['id'];
        photo.className = 'post_photo';
        photo.src = result[i]['path'];
        photo.addEventListener('click', removePostIntention);
        container.append(photo);

        //append description
        description = document.createElement('div');
        description.className = 'post_description';
        description.innerHTML += result[i]['description'];
        description.innerHTML += '<p><i>'+result[i]['add_date']+'</i></p>';
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
        comments.id = 'comments'+result[i]['id'];
        comments.addEventListener('click', showComments);
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

function removePostIntention(e) {
    let substrate = document.getElementsByClassName('substrate')[0];
    let delete_post = document.getElementsByClassName('delete_post')[0];

    delete_post.style.display = 'block';
    delete_post.style.marginTop =  window.pageYOffset+100+'px';
    substrate.style.display = 'block';

    window.onclick = (e) => {
        if (e.target === substrate) {
            substrate.style.display = 'none';
            delete_post.style.display = 'none';
        }
    };
    let button = document.getElementById('delete_post');
    button.onclick = () => { removePost(e, delete_post, substrate) };
}

function removePost(e, delete_post, substrate) {
    e.target.parentElement.remove();
    let id = e.target.id.replace('img', '');

    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'profile/deletepost', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send('id='+id);
    delete_post.style.display = 'none';
    substrate.style.display = 'none';
    let parent = document.getElementsByClassName('posts_profile')[0];
    if (parent.childElementCount === 0)
        ajaxProfileFeed(parent, 0);
    else {
        let last_post = parent.lastChild.childNodes[0].id.replace('img', '');
        ajaxGetNextPost(parent, last_post);
    }
}

function ajaxGetNextPost(parent, last_post) {
    window.scrollTo(0, 0);
    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'profile/getnextpost', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send('id='+last_post);

    ajax.onreadystatechange = () => {
        if (ajax.status !== 200) {
            location.href = 'error';
        }
        if (ajax.readyState === 4) {
            let result = JSON.parse(ajax.responseText);
            if (result.length > 0)
                addContent(parent, result);
        }
    };
}