import {
  mdiAccountCircle,
  mdiMonitor,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList
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
    ],
  },

  {
    href: "/users",
    route: 'users', // Verificar que sea ka ruta de mostrar las tablas
    label: "Usuarios",
    icon: mdiTable,
  },
  {
    route: "/profile",
    label: "Profile",
    icon: mdiAccountCircle,
  },
  
];