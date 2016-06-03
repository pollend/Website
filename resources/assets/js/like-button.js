Vue.component('like', {
    template: '#like-template',
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
            this.liked = true;

            if(this.likes != null) {
                this.likes++;
            }

            this.$http.post('/api/likes/like/' + this.type + '/' + this.id);
        },
        unlike: function() {
            this.liked = false;

            if(this.likes != null) {
                this.likes--;
            }
            
            this.$http.delete('/api/likes/unlike/' + this.type + '/' + this.id);
        },
        isLiked: function(){
            return (this.liked == 'true' || this.liked === true);
        }
    }
});

new Vue({
    el: '#site'
});