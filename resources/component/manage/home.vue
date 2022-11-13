<template>
    <div>
        <van-row justify="space-between">
            <div></div>
            <create-dialog />
        </van-row>
    </div>
</template>

<script>
import createDialog from './product/createDialog.vue'

export default {
    components: {
        createDialog
    }
}
</script>