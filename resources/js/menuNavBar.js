import {
  mdiMenu,
  mdiClockOutline,
  mdiCloud,
  mdiCrop,
  mdiDomain,
  mdiAccount,
  mdiCogOutline,
  mdiEmail,
  mdiLogout,
  mdiThemeLightDark,
  mdiGithub,
  mdiReact,
  mdiFormSelect,
  mdiAccountGroup
} from "@mdi/js";

export default [
  {
    icon: mdiMenu,
    label: "Acceso Rápido",
    menu: [
      {
        icon: mdiDomain,
        label: "Mi empresa",
      },
      {
        icon: mdiAccountGroup,
        label: "Mis clientes",
        href: "/users",
      },
      {
        isDivider: true,
      },
      {
        icon: mdiFormSelect,
        label: "Wizard form",
      },
    ],
  },
  {
    isCurrentUser: true,
    menu: [
      {
        icon: mdiAccount,
        label: "My Profile",
        to: "/profile",
      },
      {
        icon: mdiCogOutline,
        label: "Settings",
      },
      {
        icon: mdiEmail,
        label: "Messages",
      },
      {
        isDivider: true,
      },
      {
        icon: mdiLogout,
        label: "Log Out",
        isLogout: true,
      },
    ],
  },
  {
    icon: mdiThemeLightDark,
    label: "Light/Dark",
    isDesktopNoLabel: true,
    isToggleLightDark: true,
  },
  {
    icon: mdiGithub,
    label: "GitHub",
    isDesktopNoLabel: true,
    href: "https://github.com/justboil/admin-one-vue-tailwind",
    target: "_blank",
  },
  {
    icon: mdiReact,
    label: "React version",
    isDesktopNoLabel: true,
    href: "https://github.com/justboil/admin-one-react-tailwind",
    target: "_blank",
  },
  {
    icon: mdiLogout,
    label: "Log out",
    isDesktopNoLabel: true,
    isLogout: true,
  },
];
