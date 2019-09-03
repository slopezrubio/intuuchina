let breakpoints = {
    heights: {
        smallDevices: 156,
        mediumDevices: 146,
        largeDevices: 100
    },
    widths: {
        smallDevices: [100, 680],
        mediumDevices: [681, 992],
        largeDevices: [993]
    },
    isLargeDevice: () => {
        return window.innerWidth >= breakpoints.widths.largeDevices[0];
    },
    isMediumDevice: () => {
        return window.innerWidth >= breakpoints.widths.mediumDevices[0] && window.innerWidth < breakpoints.widths.mediumDevices[1];
    },
    isSmallDevice: () => {
        return window.innerWidth >= 0 && window.innerWidth < breakpoints.widths.smallDevices[1]
    }

};

export default breakpoints;