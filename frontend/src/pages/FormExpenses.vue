<template>
  <q-page>
    <div class="row justify-center">
      <div class="col-12">
        <q-form class="row justify-center" @submit.prevent="handleSubmit">
          <p class="col-12 text-h5 text-center"> Create Expense </p>
          <div class="col-md-4 col-sm-6 col-xs-10 q-gutter-y-md">
            <q-input
              label="Description"
              v-model="form.description"
            />

            <q-input
              label="Value"
              v-model="form.value"
              lazy-rules
              :rules="[
              val => !!val || 'Value is required'
            ]"
            />

            <q-input
              label="Expense Date"
              v-model="form.expense_date"
              lazy-rules
              :rules="[val => (val && val.length > 0 ) || 'Password is required']"
              type="date"
            />

            <q-btn
              :label="isUpdate ? 'Update' : 'Create'"
              color="primary"
              class="full-width"
              outline
              rounded
              type="submit"
            />
            <q-btn
              label="Back"
              color="secundary"
              class="full-width"
              outline
              rounded
              :to="{ name: 'index' }"
            />
          </div>
        </q-form>
      </div>
    </div>
  </q-page>
</template>
<script>
import { defineComponent, ref, onMounted, computed } from 'vue'
import useApi from 'src/helpers/UseApi'
import { useRouter, useRoute } from 'vue-router'
import useNotify from 'src/helpers/UseNotify'
export default defineComponent({
  name: 'FormExpenses',

  setup () {
    const router = useRouter()
    const route = useRoute()

    const { notifyError, notifySucess } = useNotify()
    const { createExpense, getExpenseById, updateExpense } = useApi()
    const isUpdate = computed(() => route.params.id)

    let expense = {}
    const form = ref({
      description: '',
      value: '',
      expense_date: ''
    })

    onMounted(() => {
      if (isUpdate.value) {
        handleGetExpense(isUpdate.value)
      }
    })

    const handleSubmit = async () => {
      try {
        if (isUpdate.value) {
          await updateExpense(form.value)
          notifySucess('Expense updated with sucess!')
          await router.push({ name: 'index' })

          return
        }

        await createExpense(form.value)
        notifySucess('Expense create with sucess!')
        await router.push({ name: 'index' })
      } catch (error) {
        notifyError(error.message)
      }
    }
    const handleGetExpense = async (id) => {
      try {
        expense = await getExpenseById(id)
        form.value = expense
      } catch (error) {
        notifyError(error.message)
      }
    }

    return {
      form,
      handleSubmit,
      isUpdate
    }
  }
})
</script>
