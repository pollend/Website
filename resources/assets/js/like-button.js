var like = new Vue({
    el: '.like',
    data: {
    },
    props: ['likes', 'liked', 'type', 'id'],
    methods: {
        toggleLike: function()
        {
            if(this.isLiked()) {
                this.unlike()
            } else {
                this.like()
            }
        },
        like: function() {
            console.log('like');
            this.liked = true;
            this.likes++;

            this.$http.post('/api/likes/like/' + this.type + '/' + this.id);
        },
        unlike: function() {
            console.log('unlike');
            this.liked = false;
            this.likes--;

            this.$http.delete('/api/likes/unlike/' + this.type + '/' + this.id);
        },
        isLiked: function(){
            return (this.liked == 'true' || this.liked === true);
        }
    }
});