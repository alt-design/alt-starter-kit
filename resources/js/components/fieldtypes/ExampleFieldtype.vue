<template>
    <div class="example-fieldtype-container">
        <Input :model-value="value" @update:model-value="update" />
    </div>
</template>

<script>
// Statamic 6: Vue 3 + import from @statamic/cms
// https://statamic.dev/extending/fieldtypes/
import { FieldtypeMixin } from '@statamic/cms';
import { Input } from '@statamic/cms/ui';

export default {
    mixins: [FieldtypeMixin],
    components: { Input },
    data() {
        return {};
    },
};
</script>
