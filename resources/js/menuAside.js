import {
  mdiAccountCircle,
  mdiMonitor,
  mdiLock,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList
} from "@mdi/js";

export default [
  'General', 
  {
    route: "dashboard",
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
        route: "#" //Colocar la tuta del primer Formulario
      },
      {
        label: "Wizard",
        icon: mdiSquareEditOutline,
        route: "#" //Colocar la ruta del segundo Formulario
      },
    ],
  },

  {
    href: "users",
    route: 'users', // Verificar que sea ka ruta de mostrar las tablas
    label: "Usuarios",
    icon: mdiTable,
  },
  {
    route: "/profile",
    label: "Profile",
    icon: mdiAccountCircle,
  },
  {
    route: "/login",
    label: "Login",
    icon: mdiLock,
  },
  
];