const {
    Grid, TextField, makeStyles, withStyles, InputAdornment, Select, Paper, MuiThemeProvider, createMuiTheme, Typography,
    Button, CircularProgress, SvgIcon, Snackbar, Alert, IconButton
} = MaterialUI;

const useStyles = makeStyles(theme => ({
    root: {
        padding: 30,
        maxWidth: 600,
        width: "auto",
        margin: "0 auto"
    },
    control: {
        fontSize: 20
    },
    option: {
        fontSize: 15,
        '& > span': {
            marginRight: 10,
            fontSize: 18,
        },
    },
    button: {
        backgroundColor: "#ff9d3a !important",
        padding: "6px 16px !important",
        color: "#fff !important",
        border: "unset important",
        marginTop: "0px important",
        border: "1px solid #ff9d3a !important"
    },
    buttonOut: {
        backgroundColor: "transparent !important",
        padding: "6px 16px !important",
        color: "#ff9d3a !important",
        border: "1px solid #ff9d3a important",
        marginTop: "0px important",
        marginRight: 1,
        marginLeft: 1,
        border: "1px solid #ff9d3a !important"
    },
    icon: {
        color: "#ff9d3a"
    }
}));

const theme = createMuiTheme({
    typography: {
        fontFamily: 'Roboto',
        fontSize: 22,
    },
});

const CustomTextField = withStyles({
    root: {
        '& label.Mui-focused': {
            color: '#000',
        },
        '& .MuiInput-underline:after': {
            borderBottomColor: '#ff9d3a',
        },
        '& .MuiOutlinedInput-root': {
            '&:hover fieldset': {
                borderColor: '#ff9d3a',
            },
            '&.Mui-focused fieldset': {
                borderColor: '#ff9d3a',
            },
        },
    },
})(TextField);

function Customer() {

    const classes = useStyles();
    const [sendingOtp, setSendingOtp] = React.useState(false);
    const [showOtpField, setShowOtpField] = React.useState(false);
    const [isPhoneError, setPhoneError] = React.useState(false);
    const [isRegisteredUser, setIsRegisteredUser] = React.useState(false);
    const [isLoggingWithPassword, setLoggingWithPassword] = React.useState(false);
    const [hasError, setErrorRequest] = React.useState(false);
    const [errorMessage, setErrorMessage] = React.useState("");

    const handleSubmit = (event) => {
        event.preventDefault();
        const phoneNumber = event.target.phone.value;
        let otp = false;

        if (typeof event.target.otp !== "undefined") {
            otp = event.target.otp.value;
        }

        if (parseInt(phoneNumber.length) === 10) {
            setSendingOtp(true);

            let request = {
                phone: phoneNumber
            };

            if (isLoggingWithPassword) {
                request = {...request, ...{password: event.target.password.value}}
                axios.post(HOST + "api/customers/verifyCustomer.json", request).then((res) => {
                    if (!res.data.statusCode) {
                        setSendingOtp(false);
                        setErrorRequest(true);
                        setErrorMessage(res.data.message);
                    }
                    if (res.data.redirectNow) {
                        window.location.href = "/";
                    }
                }).catch((error) => {
                    setSendingOtp(false);
                });
            } else if (otp) {
                request = {...request, ...{otp: event.target.otp.value}}
                axios.post(HOST + "api/customers/verifyCustomer.json", request).then((res) => {
                    if (!res.data.statusCode) {
                        setSendingOtp(false);
                        setErrorRequest(true);
                        setErrorMessage(res.data.message);
                    }
                    if (res.data.redirectNow) {
                        window.location.href = "/";
                    }
                }).catch((error) => {
                    setSendingOtp(false);
                });
            } else {
                axios.post(HOST + "api/customers/validateCustomerAndSendOtp.json", request).then((res) => {
                    setIsRegisteredUser(res.data.response.isRegistered);
                    setShowOtpField(true);
                    setSendingOtp(false);
                }).catch((error) => {
                    setSendingOtp(false);
                    setPhoneError(true);
                });
            }
        } else {
            setPhoneError(true);
        }
    }

    const resetToBeginning = () => {
        setSendingOtp(false);
        setShowOtpField(false);
        setPhoneError(false);
        setIsRegisteredUser(false);
        setLoggingWithPassword(false);
    }

    return (
        <React.Fragment>
            <Paper className={classes.root}>
                <Typography variant="h2" align="center">Welcome to HP Singh Family</Typography>
                <form onSubmit={handleSubmit}>
                    <Grid container spacing={2}>
                        <Grid item xs={12} sm={12}>
                            <CustomTextField
                                fullWidth
                                variant="outlined"
                                label="Mobile Number"
                                name="phone"
                                required={true}
                                error={isPhoneError}
                                InputProps={{
                                    endAdornment: (
                                        <InputAdornment position="start">
                                            <PhoneIcon/>
                                        </InputAdornment>
                                    ),
                                }}
                            />
                        </Grid>
                        {
                            showOtpField &&
                            <Grid item xs={12} sm={12}>
                                <CustomTextField
                                    fullWidth
                                    variant="outlined"
                                    label={isLoggingWithPassword ? "Password" : "Type OTP"}
                                    name={isLoggingWithPassword ? "password" : "otp"}
                                    required={true}
                                    InputProps={{
                                        endAdornment: (
                                            <InputAdornment position="start">
                                                <OtpIcon/>
                                            </InputAdornment>
                                        ),
                                    }}
                                />
                            </Grid>
                        }
                        <Grid item xs={12} sm={12}>
                            <Button className={classes.button} disabled={sendingOtp} variant="contained" size="medium"
                                    type="submit">
                                {
                                    sendingOtp
                                        ? <CircularProgress size={22} color="secondary"/>
                                        : isRegisteredUser
                                        ? "Login"
                                        : "Continue"
                                }
                            </Button>
                            {
                                isRegisteredUser ?
                                    !isLoggingWithPassword
                                        ? <Button
                                            className={classes.buttonOut}
                                            variant="outlined"
                                            onClick={() => setLoggingWithPassword(true)}>
                                            Login With Password
                                        </Button>
                                        : <Button
                                            className={classes.buttonOut}
                                            variant="outlined"
                                            onClick={resetToBeginning}>
                                            Login With OTP
                                        </Button>
                                    : ""
                            }
                        </Grid>
                    </Grid>
                </form>
            </Paper>
            {
                hasError &&
                <ShowSnackBar message={errorMessage}/>
            }
        </React.Fragment>
    )
        ;
}

function RegistrationForm() {
    const classes = useStyles();
    const handleSubmit = () => {

    }

    return (
        <React.Fragment>
            <Paper className={classes.root}>
                <Typography variant="h2" align="center">Welcome to HP Singh Family</Typography>
                <form onSubmit={handleSubmit}>
                    <Grid container spacing={2}>
                        <Grid item xs={12} sm={12}>
                            <CustomTextField
                                fullWidth
                                variant="outlined"
                                label="Name"
                                name="name"
                                required={true}
                                InputProps={{
                                    endAdornment: (
                                        <InputAdornment position="start">
                                            <ProfileIcon/>
                                        </InputAdornment>
                                    ),
                                }}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12}>
                            <CustomTextField
                                fullWidth
                                variant="outlined"
                                label="Email Address"
                                name="email"
                                required={true}
                                InputProps={{
                                    endAdornment: (
                                        <InputAdornment position="start">
                                            <EmailIcon/>
                                        </InputAdornment>
                                    ),
                                }}
                            />
                        </Grid>
                        <Grid item xs={12} sm={12}>
                            <CustomTextField
                                fullWidth
                                variant="outlined"
                                label="Password"
                                name="password"
                                required={true}
                                type="password"
                                InputProps={{
                                    endAdornment: (
                                        <InputAdornment position="start">
                                            <LockIcon/>
                                        </InputAdornment>
                                    ),
                                }}
                            />
                        </Grid>

                        <Grid item xs={12} sm={12}>
                            <CustomTextField
                                fullWidth
                                variant="outlined"
                                label="Confirm Password"
                                name="confirmPassword"
                                required={true}
                                type="password"
                                InputProps={{
                                    endAdornment: (
                                        <InputAdornment position="end">
                                            <IconButton>
                                                <VisibilityIcon/>
                                            </IconButton>
                                        </InputAdornment>
                                    ),
                                }}
                            />
                        </Grid>

                        <Grid item xs={12} sm={12}>
                            <Button
                                className={classes.button}
                                variant="outlined"
                            >
                                Sign Up
                            </Button>
                        </Grid>
                    </Grid>
                </form>
            </Paper>
        </React.Fragment>
    );
}

function MyAccount() {
    const [userCountry, setUserCountry] = React.useState(false);

    React.useEffect(() => {
        const getCustomerCountry = async () => {
            await axios.get("https://ipapi.co/json/")
                .then((res) => {
                    setUserCountry(res.data.country);
                })
        };

        getCustomerCountry();
    });

    return (
        <React.Fragment>
            {
                userCountry && userCountry === "IN" ? <Customer/> : "ABC"
            }
        </React.Fragment>
    );
}

function ShowSnackBar(props) {
    const [isOpen, setOpen] = React.useState(true);

    const handleClose = () => {
        setOpen(false);
    };

    return (
        <Snackbar
            anchorOrigin={{vertical: 'bottom', horizontal: "center"}}
            open={isOpen}
            onClose={handleClose}
            message={props.message}
            key="bottomcenter"
            autoHideDuration={2000}
        />
    );
}

function PhoneIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M20.1 7.7l-1 1c1.8 1.8 1.8 4.6 0 6.5l1 1c2.5-2.3 2.5-6.1 0-8.5zM18 9.8l-1 1c.5.7.5 1.6 0 2.3l1 1c1.2-1.2 1.2-3 0-4.3zM14 1H4c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 19H4V4h10v16z"/>
        </SvgIcon>
    );
}

function VisibilityIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
        </SvgIcon>
    );
}

function VisibilityOffIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>
        </SvgIcon>
    );
}

function EmailIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
        </SvgIcon>
    );
}

function LockIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1s3.1 1.39 3.1 3.1v2H8.9V6zM18 20H6V10h12v10z"/>
        </SvgIcon>
    );
}

function ProfileIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1z"/>
        </SvgIcon>
    );
}

function OtpIcon() {
    const classes = useStyles();
    return (
        <SvgIcon className={classes.icon}>
            <path
                d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
        </SvgIcon>
    );
}

ReactDOM.render(
    <MuiThemeProvider theme={theme}>
        <MyAccount/>
        <RegistrationForm/>
    </MuiThemeProvider>, document.getElementById('userForms'));
