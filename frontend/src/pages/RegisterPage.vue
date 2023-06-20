<template>
  <q-page padding>
    <q-form class="row justify-center" @submit.prevent="handleRegister">
      <p class="col-12 text-h5 text-center"> Register </p>
      <div class="col-md-4 col-sm-6 col-xs-10 q-gutter-y-md">
        <q-input
          label="Name"
          v-model="form.name"
          lazy-rules
          :rules="[val => (val && val.length > 0 ) || 'Name is required']"
        />

        <q-input
          label="Email"
          v-model="form.email"
          lazy-rules
          :rules="[val => (val && val.length > 0 ) || 'Email is required']"
          type="email"
        />

        <q-input
          label="Password"
          v-model="form.password"
          lazy-rules
          :rules="[val => (val && val.length > 0 ) || 'Password is required']"
          type="password"
        />

        <q-btn
          label="Register"
          color="primary"
          class="full-width"
          outline
          rounded
          type="submit"
        />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { defineComponent, ref } from 'vue'
import useAuthUser from 'src/helpers/UseAuthUser'
import { useRouter } from 'vue-router'
import useNotify from 'src/helpers/UseNotify'
export default defineComponent({
  name: 'LoginPage',

  setup () {
    const router = useRouter()

    const { register } = useAuthUser()
    const { notifyError, notifySucess } = useNotify()

    const form = ref({
      name: '',
      email: '',
      password: ''
    })
    const handleRegister = async () => {
      try {
        await register(form.value)
        notifySucess('User create with sucess!')
        await router.push({ name: 'index' })
      } catch (error) {
        notifyError(error.message)
      }
    }
    return {
      form,
      handleRegister
    }
  }
})
</script>
