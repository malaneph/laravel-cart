<script setup>
import { SelectValue } from "reka-ui";

const props = defineProps({
  placeholder: { type: String, required: false },
  asChild: { type: Boolean, required: false },
  as: { type: [String, Object, Function], required: false },
});
</script>

<template>
  <SelectValue v-bind="props">
    <slot />
  </SelectValue>
</template>
