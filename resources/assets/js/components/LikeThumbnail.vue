<template>
    <div>
        <i class="fa fa-heart" v-bind:class="{ 'fa-heart': likeState, 'fa-heart-o': !likeState }"  v-on:click="toggleLike"></i>

        <span v-if="!hideCount">
            {{ likeCount }}
        </span>
    </div>
</template>

<script>
    import LikeButton from './LikeButton'
    export default {
        extends: LikeButton
    }
</script>