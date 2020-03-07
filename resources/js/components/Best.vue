<template>
    <ul class="list-group list-striped" style="font-size: 13px;">
        <li class="list-group-item text-light h6 m-0" style="background:#880">
            <div class="row">
                <div class="best_move left col-2" @click="moveBest('left')"><</div>
                <div class="col-8 text-center">
                    인기 {{bestPostsKorean[board]}}
                </div>
                <div class="best_move right col-2" @click="moveBest('right')">></div>
            </div>            
        </li>
        <li class="list-group-item p-2 px-4"  v-for="bestPost in bestPosts[board]" style="border:0">
            <a :href="'/post/'+bestPost.id+'?board='+bestPost.board" class="text-dark">
            {{bestPost.title}}</a>
        </li>
    </ul>  
</template>

<script>
export default {

    data() {
        return {
            board: 0,
            bestPosts: [],
            bestPostsKorean: []
        }
    },
    created() {
        axios.get('/best?board='+this.board).then(res=>{
            this.bestPosts = res.data.best_posts
            this.bestPostsKorean = res.data.best_posts_korean
        }).catch(

        );
    },

    methods: {
        moveBest(direction) {
            if(direction==='right') {
                if(this.board===4) {
                    this.board=0;
                } 
                else {
                    this.board++;
                }
            }
            else if(direction==='left') {
                if(this.board===0) {
                    this.board=4;
                } 
                else {
                    this.board--;
                }
            }
        }
    }

}
</script>
<style>
    .list-striped li:nth-child(2n-1) {
        background: #eee;
    }
    .best_move {
        color: #fff;
        background: rgba(0,0,0,0.3);
        cursor: pointer;
        text-align: center;
    }

</style>