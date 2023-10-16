import {
  mdiAccountCircle,
  mdiMonitor,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiHome
} from "@mdi/js";

export default [
  {
    href: "/dashboard",
    icon: mdiMonitor,
    label: "Dashboard",
  },
  {
    label: "Formularios",
    icon: mdiViewList,
    menu: [
      {
        label: "Normal",
        icon: mdiSquareEditOutline,
        href: "/company" //Colocar la tuta del primer Formulario
      },
      {
        label: "Wizard",
        icon: mdiSquareEditOutline,
        href: "/company/wizard" //Colocar la ruta del segundo Formulario
      },
      {
        label: "Colors",
        icon: mdiSquareEditOutline,
        href: "/company/colors" //Colocar la ruta del tercer Formulario
      },
      {
        label: "Social Media",
        icon: mdiSquareEditOutline,
        href: "/company/media" //Colocar la ruta del cuarto Formulario
      }, 
      {
        label: "Posts and Videos",
        icon: mdiSquareEditOutline,
        href: "/company/post" //Colocar la ruta del cuarto Formulario
      }
    ],
  },

  // {
  //   href: "/users",
  //   route: 'users', // Verificar que sea ka ruta de mostrar las tablas
  //   label: "Usuarios",
  //   icon: mdiTable,
  // },
  {
    route: "/profile",
    label: "Profile",
    icon: mdiAccountCircle,
  },
  {
    route: "/home",
    href: "/index",
    label: "Home",
    icon: mdiHome,
  }
  
];