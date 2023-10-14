<script setup>

const splitName = (name) => {
  if(name.split(' ').length > 1) {
    return name.split(' ')
  }else{
    
    const limit = Math.floor(name.length / 3) * 2
    console.log(limit)
    const first = name.slice(0, limit)
    const second = name.slice(limit, name.length)
    return [first, second]
  }
  
}

  defineProps({
    colors: {
      type: Object,
      required: false,
    },
    company: {
      type: Object,
      required: false,
    }
  })

</script>

<template>
  <footer id="footer">
    <div class="grid grid-cols-1 ml-11 md:grid-cols-2 gap-10 md:gap-28">
      <div class="flex">
        <div class="flex gap-2 mb-5">
          <h1 class="text-white font-bold text-2xl lg:ml-20" :style="{color : colors ? colors.color4 : ''}">{{ company ? `${splitName(company.name)[0]} ` : 'Hallow'}}<span class="text-secondary" :style="{color: colors ? colors.color5 : '',}">{{ company ? splitName(company.name)[1] : 'ee' }}</span>{{ company ? '' : 'd' }}</h1>
          <img v-if="colors" class="h-32 w-full lg:-translate-x-10 scale-x-[1] lg:scale-100" :src="`/images/${colors.file}`">
          <svg  v-else class="w-7 lg:w-9" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19.071 4.929a9.936 9.936 0 0 0-7.07-2.938 9.943 9.943 0 0 0-7.072 2.938c-3.899 3.898-3.899 10.243 0 14.142a9.94 9.94 0 0 0 7.073 2.938 9.936 9.936 0 0 0 7.07-2.937c3.899-3.898 3.899-10.243-.001-14.143zM12.181 4h-.359c.061-.001.119-.009.18-.009s.118.008.179.009zm6.062 13H16l-1.258 2.516a7.956 7.956 0 0 1-2.741.493 7.96 7.96 0 0 1-2.746-.494L8 17.01H5.765a7.96 7.96 0 0 1-1.623-3.532L6 11 4.784 8.567a7.936 7.936 0 0 1 1.559-2.224 7.994 7.994 0 0 1 3.22-1.969L12 6l2.438-1.625a8.01 8.01 0 0 1 3.22 1.968 7.94 7.94 0 0 1 1.558 2.221L18 11l1.858 2.478A7.952 7.952 0 0 1 18.243 17z"></path><path d="m8.5 11 1.5 4h4l1.5-4L12 8.5z"></path></svg>
        </div>
        <div class="flex justify-end md:justify-start -mt-7 md:mt-3 max-w-fit ml-28">
          <iframe class="lg:h-40 w-full " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8116055.595140307!2d-66.61467055!3d6.65711345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2853cb36cbd801%3A0xdca0f2587cd54dd3!2sVenezuela!5e0!3m2!1ses-419!2sve!4v1697299146542!5m2!1ses-419!2sve" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center gap-12 text-white" :style="{color: colors ? colors.color4 : '',}">
        <div>
          <h3 class="mb-4 font-bold text-3xl md:text-lg ">About</h3>
          <div class="flex flex-col gap-3 text-xl">
            <a href="#" class="hover:underline">About Us</a>
            <a href="#" class="hover:underline">Feature</a>
            <a href="#" class="hover:underline">Career</a>
          </div>
        </div>
        <div>
          <h3 class="mb-4 font-bold text-3xl md:text-lg">Company</h3>
          <div class="flex flex-col gap-3 text-xl">
            <a href="#" class="hover:underline">Our Team</a>
            <a href="#" class="hover:underline">Partners</a>
            <a href="#" class="hover:underline">Question</a>
          </div>
        </div>
        <div>
          <h3 class="mb-4 font-bold text-3xl md:text-lg">Service</h3>
          <div class="flex flex-col gap-3 text-xl">
            <a href="#" class="hover:underline">Support</a>
            <a href="#" class="hover:underline">Feedback</a>
            <a href="#" class="hover:underline">Contact</a>
          </div>
        </div>
      </div>
    </div>

    <div class="grid place-items-center my-20 w-full" :style="{color: colors ? colors.color4 : ''}">
      <div class="flex items-center gap-10">
        <a href="#" class="h-12 w-12 grid place-items-center rounded-md">
          <!-- <img src="../assets/images/social/fb.svg" alt=""> -->
          <svg class="w-16 h-auto"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" :style="{fill: colors ? colors.color4 : ''}"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>
        </a>
        <a href="#" class="h-12 w-12 grid place-items-center rounded-md">
          <!-- <img src="../assets/images/social/instagram.svg" alt=""> -->
          <svg class="w-16 h-auto"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" :style="{fill: colors ? colors.color4 : ''}"><path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path><circle cx="16.806" cy="7.207" r="1.078"></circle><path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path></svg>
        </a>
        <a href="#" class="h-12 w-12 grid place-items-center rounded-md">
          <!-- <img src="../assets/images/social/twitter.svg" alt=""> -->
          <svg class="w-16 h-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" :style="{fill: colors ? colors.color4 : ''}"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path></svg>
        </a>
        <a href="#" class="h-12 w-12 grid place-items-center rounded-md">
          <!-- <img src="../assets/images/social/twitter.svg" alt=""> -->
          <svg class="w-16 h-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" :style="{fill: colors ? colors.color4 : ''}"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z"></path></svg>
        </a>
      </div>
      <p class="md:text-lg font-medium text-center text-white mt-8 tracking-wider" :style="{color: colors ? colors.color4 : ''}">
        &copy; Copyright, SSC Programming Group, All rights reserved.
      </p>
    </div>
  </footer>
</template>