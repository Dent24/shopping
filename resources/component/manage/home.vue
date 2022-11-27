<template>
    <v-container>
        <div class="d-flex justify-end">
            <create-dialog />
        </div>
    </v-container>
</template>

<script>
import createDialog from './product/createDialog.vue'

export default {
    components: {
        createDialog
    }
}
</script>