<template>
    <div class="text-center mb-3">
        <button 
            v-if="likeNumber!==null"
            @click="like" 
            class="btn btn-dark mx-auto"
            :class="{ 'btn-success' : alreadyLike }"
            >
        좋아요: {{likeNumber}}
        </button>
    </div>    
</template>

<script>
export default {
    props: {
        postId: {
            type: Number,
            required: true
        },
        isLoggedIn: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            likeNumber: null,
            alreadyLike: null
        }
    },
    created() {
        axios.get('/like/' + this.postId).then(res=>{
            this.likeNumber = res.data.like_number[0],
            this.alreadyLike = res.data.already_like
        }).catch(

        );
    },
    methods: {
        like() {
            if(!this.alreadyLike) {
                if(this.isLoggedIn) {
                    axios.post('/like/' + this.postId, {});
                    this.likeNumber = this.likeNumber + 1;
                    this.alreadyLike = 1;
                }
                else {
                    alert('로그인 후 이용 가능합니다.');
                }
            }
            else {
                alert('이미 좋아요를 누르셨습니다.');
            }
            
        }
    }
}
</script>