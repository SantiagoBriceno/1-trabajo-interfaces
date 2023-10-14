<script setup>
defineProps({
  img: {
    type: String,
    required: false
  },
  url: {
    type: String,
    required: false
  }
});
</script>
<template>
  <a v-if="img != null" :href="url">
    <div class="cube">
      <div class="face face--front">
        <img :src="`/images/media/${img}`" alt="Foto logo" />
      </div>
      <div class="face face--right">
        <img :src="`/images/media/${img}`" alt="Foto logo" />
      </div>
      <div class="face face--back">
        <img :src="`/images/media/${img}`" alt="Foto logo" />
      </div>
      <div class="face face--left">
        <img :src="`/images/media/${img}`" alt="Foto logo" />
      </div>
      <div class="face face--top">
        <img :src="`/images/media/${img}`" alt="Foto logo" />
      </div>
      <div class="face face--bottom">
        <img :src="`/images/media/${img}`" alt="Foto logo" />
      </div>
    </div>
  </a>
</template>
<style>
/* body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  perspective: 500px;
} */

@media screen and (min-width: 1024px) {
  .cube {
  width: 200px;
  height: 200px;
  animation: rotate 5s linear infinite;
  transform-style: preserve-3d;
  }

  .face {
    background: white;
    border: 2px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 10px;
    font-weight: bold;
    color: #234e52;

    width: 100px;
    height: 100px;
    position: absolute;
  }

.face--front {
  transform: translateZ(50px);
}

.face--right {
  transform: rotateY(90deg) translateZ(50px);
}

.face--back {
  transform: rotateY(180deg) translateZ(50px);
}

.face--left {
  transform: rotateY(-90deg) translateZ(50px);
}

.face--top {
  transform: rotateX(90deg) translateZ(50px);
}

.face--bottom {
  transform: rotateX(-90deg) translateZ(50px);
}
}

@media screen and (max-width: 1023px) {
  .cube {
  width: 100px;
  height: 100px;
  animation: rotate 5s linear infinite;
  transform-style: preserve-3d;
  }

  .face {
    background: white;
    border: 2px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 10px;
    font-weight: bold;
    color: #234e52;

    width: 50px;
    height: 50px;
    position: absolute;
  }
  .face--front {
  transform: translateZ(25px);
}

.face--right {
  transform: rotateY(90deg) translateZ(25px);
}

.face--back {
  transform: rotateY(180deg) translateZ(25px);
}

.face--left {
  transform: rotateY(-90deg) translateZ(25px);
}

.face--top {
  transform: rotateX(90deg) translateZ(25px);
}

.face--bottom {
  transform: rotateX(-90deg) translateZ(25px);
}
}

@keyframes rotate {
  0% {
    transform: rotateX(-30deg) rotateY(0deg);
  }

  100% {
    transform: rotateX(-30deg) rotateY(360deg);
  }
}
</style>