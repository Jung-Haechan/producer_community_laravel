<template>
    <div class="bg-light p-3 pt-4" style="border-radius:5px;">
        <div class="row">
            <div class="col-2 text-center" @click="moveHof('left')" style="cursor:pointer">
                <strong><</strong>
            </div>
            <div class="col-8 text-center">
                <strong>{{hofs[hofNum]['title']}}</strong>
            </div>
            <div class="col-2 text-center" @click="moveHof('right')" style="cursor:pointer">
                <strong>></strong>
            </div>
        </div>

        <audio :src="'storage/'+ hofs[hofNum]['file_name'].split('/')[1]" controls class="my-3" style="width:100%">
        </audio>
        <div style="font-size:14px; min-height: 100px">
            {{hofs[hofNum]['description']}}
        </div>
        <div style="font-size: 12px;">
            작곡가: {{hofs[hofNum]['composer']}} | 작사가: {{hofs[hofNum]['lyricist']}} | 보컬/악기: {{hofs[hofNum]['performer']}}
        </div>
    </div>
</template>
<script>
export default {
    props: {
        hofs: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            hofNum: 0
        }
    },
    methods: {
        moveHof(direction) {
            if(direction==='right') {
                if(this.hofNum===this.hofs.length-1) {
                    this.hofNum=0;
                } 
                else {
                    this.hofNum++;
                }
            }
            else if(direction==='left') {
                if(this.hofNum===0) {
                    this.hofNum=this.hofs.length-1;
                } 
                else {
                    this.hofNum--;
                }
            }
        }
    }
}
</script>